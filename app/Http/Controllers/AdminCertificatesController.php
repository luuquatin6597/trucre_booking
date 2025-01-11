<?php

namespace App\Http\Controllers;

use App\Models\Buildings;
use App\Models\Certificates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminCertificatesController extends Controller
{

    public function index()
    {
        $certificates = Certificates::with('building') // Tải thông tin building cho mỗi certificate
        ->whereHas('building', function($query) {
            $query->where('status', 'active'); // Chỉ lấy các building có status 'waiting'
        })
        ->get();
        // Trả dữ liệu về view
        return view('admin.Admin-certificates', compact('certificates'));
    }


    public function show($id)
    {
        $building = Buildings::findOrFail($id);

    }

    // Chấp nhận chứng chỉ (accept)
    public function accept($id)
    {
        $building = Buildings::findOrFail($id); // Tìm building theo ID

        $building->status = 'active'; // Cập nhật trạng thái thành "approved"
        $building->save(); // Lưu vào database

        return response()->json([
            'success' => true,
            'message' => 'Certificate accepted successfully!',
        ]);
    }

    // Từ chối chứng chỉ (reject)
    public function reject($id)
    {
        $building = Buildings::findOrFail($id); // Tìm building theo ID

        $building->status = 'rejected'; // Cập nhật trạng thái thành "rejected"
        $building->save(); // Lưu vào database

        return response()->json([
            'success' => true,
            'message' => 'Certificate rejected successfully!',
        ]);
    }

    public function uploadCertificate(Request $request, $id)
    {
        $building = Buildings::findOrFail($id);
        $files = Certificates::where('building_id', $building->id)->get();

        return view('admin.buildings.upoad-image', compact('room', 'files'));
    }

    public function storeCertificate(Request $request, $id)
    {
        try {
            $building = Buildings::findOrFail($id);
            $request->validate([
                'certificates' => 'required',
                'certificates.*' => 'required|file|mimes:jpeg,png,jpg,pdf',
            ]);

            $certificateData = [];
            foreach ($request->file('certificates') as $key => $file) {
                $extention = $file->getClientOriginalExtension();
                $filename = time() . '-' . $id . '-' . $key . '.' . $extention;
                $path = 'certificates/' . $filename;
                $file->move(public_path('certificates'), $filename);
                $certificateData[] = [
                    'building_id' => $building->id,
                    'url' => $path
                ];
            }

            return Certificates::insert($certificateData);
        } catch (\Exception $e) {
            return redirect()->route('admin.buildings')
                ->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function deleteCertificate(Request $request, $id)
    {
        $certificate = Certificates::findOrFail($id);
        if (File::exists(public_path($certificate->url))) {
            File::delete(public_path($certificate->url));
        }
        $certificate->delete();
        return redirect()->route('admin.buildings.upload', $certificate->room_id)
            ->with('success', 'certificate deleted successfully!');
    }
}
