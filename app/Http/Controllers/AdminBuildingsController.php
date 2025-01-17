<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Models\Buildings;
use App\Models\User;


class AdminBuildingsController extends Controller
{
    public function AdminBuildings()
    {
        $listCountry = [
            'Afghanistan',
            'Albania',
            'Algeria',
            'Andorra',
            'Angola',
            'Antigua and Barbuda',
            'Argentina',
            'Armenia',
            'Australia',
            'Austria',
            'Azerbaijan',
            'Bahamas',
            'Bahrain',
            'Bangladesh',
            'Barbados',
            'Belarus',
            'Belgium',
            'Belize',
            'Benin',
            'Bhutan',
            'Bolivia',
            'Bosnia and Herzegovina',
            'Botswana',
            'Brazil',
            'Brunei',
            'Bulgaria',
            'Burkina Faso',
            'Burundi',
            'Cabo Verde',
            'Cambodia',
            'Cameroon',
            'Canada',
            'Central African Republic',
            'Chad',
            'Chile',
            'China',
            'Colombia',
            'Comoros',
            'Congo (Republic)',
            'Congo (Democratic Republic)',
            'Costa Rica',
            'Croatia',
            'Cuba',
            'Cyprus',
            'Czech Republic',
            'Denmark',
            'Djibouti',
            'Dominica',
            'Dominican Republic',
            'East Timor',
            'Ecuador',
            'Egypt',
            'El Salvador',
            'Equatorial Guinea',
            'Eritrea',
            'Estonia',
            'Eswatini',
            'Ethiopia',
            'Fiji',
            'Finland',
            'France',
            'Gabon',
            'Gambia',
            'Georgia',
            'Germany',
            'Ghana',
            'Greece',
            'Grenada',
            'Guatemala',
            'Guinea',
            'Guinea-Bissau',
            'Guyana',
            'Haiti',
            'Honduras',
            'Hungary',
            'Iceland',
            'India',
            'Indonesia',
            'Iran',
            'Iraq',
            'Ireland',
            'Israel',
            'Italy',
            'Jamaica',
            'Japan',
            'Jordan',
            'Kazakhstan',
            'Kenya',
            'Kiribati',
            'North Korea',
            'South Korea',
            'Kosovo',
            'Kuwait',
            'Kyrgyzstan',
            'Laos',
            'Latvia',
            'Lebanon',
            'Lesotho',
            'Liberia',
            'Libya',
            'Liechtenstein',
            'Lithuania',
            'Luxembourg',
            'Madagascar',
            'Malawi',
            'Malaysia',
            'Maldives',
            'Mali',
            'Malta',
            'Marshall Islands',
            'Mauritania',
            'Mauritius',
            'Mexico',
            'Micronesia',
            'Moldova',
            'Monaco',
            'Mongolia',
            'Montenegro',
            'Morocco',
            'Mozambique',
            'Myanmar',
            'Namibia',
            'Nauru',
            'Nepal',
            'Netherlands',
            'New Zealand',
            'Nicaragua',
            'Niger',
            'Nigeria',
            'North Macedonia',
            'Norway',
            'Oman',
            'Pakistan',
            'Palau',
            'Palestine',
            'Panama',
            'Papua New Guinea',
            'Paraguay',
            'Peru',
            'Philippines',
            'Poland',
            'Portugal',
            'Qatar',
            'Romania',
            'Russia',
            'Rwanda',
            'Saint Kitts and Nevis',
            'Saint Lucia',
            'Saint Vincent and the Grenadines',
            'Samoa',
            'San Marino',
            'Sao Tome and Principe',
            'Saudi Arabia',
            'Senegal',
            'Serbia',
            'Seychelles',
            'Sierra Leone',
            'Singapore',
            'Slovakia',
            'Slovenia',
            'Solomon Islands',
            'Somalia',
            'South Africa',
            'South Sudan',
            'Spain',
            'Sri Lanka',
            'Sudan',
            'Suriname',
            'Sweden',
            'Switzerland',
            'Syria',
            'Taiwan',
            'Tajikistan',
            'Tanzania',
            'Thailand',
            'Togo',
            'Tonga',
            'Trinidad and Tobago',
            'Tunisia',
            'Turkey',
            'Turkmenistan',
            'Tuvalu',
            'Uganda',
            'Ukraine',
            'United Arab Emirates',
            'United Kingdom',
            'United States',
            'Uruguay',
            'Uzbekistan',
            'Vanuatu',
            'Vatican',
            'Venezuela',
            'Việt Nam',
            'Yemen',
            'Zambia',
            'Zimbabwe'
        ];
        $user = Auth::user();
        $role = $user->role;
        $buildings = Buildings::with('user')
            ->when($role === 'owner', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->get();

        return view('admin.admin-buildings', compact('buildings', 'role', 'listCountry'));
    }

    public function getBuilding($id)
    {
        $building = Buildings::with('user', 'rooms')->findOrFail($id);
        return view('admin.buildings.building-detail', ['building' => $building]);
    }

    public function addBuilding(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'address' => 'required|string|max:2048',
                'country' => 'required|string',
                'map' => 'required|url|max:2048',
                'user_id' => 'required|exists:users,id',
                'status' => 'required|in:waiting,active',
            ]);

            $building = Buildings::create([
                'user_id' => $validatedData['user_id'],
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'address' => $validatedData['address'],
                'country' => $validatedData['country'],
                'map' => $validatedData['map'],
                'status' => $validatedData['status']
            ]);

            $user = Auth::user();

            if ($user->role === 'owner') {
                if (!$request->hasFile('certificates')) {
                    return redirect()->route('admin.buildings')->with('error', 'Please upload certificates');
                }

                $certificateController = new AdminCertificatesController();
                $certificateController->storeCertificate($request, $building->id);
            }
            return redirect()->route('admin.buildings')->with('success', 'Building added successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.buildings')->with('error', 'Failed to add building: ' . $e->getMessage());
        }
    }

    public function updateBuilding(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'address' => 'required|string|max:2048',
                'country' => 'required|string|max:255',
                'map' => 'required|url|max:2048',
                'status' => 'required|in:waiting,active,inactive',
            ]);

            $building = Buildings::findOrFail($id);
            $building->name = $validatedData['name'];
            $building->description = $validatedData['description'];
            $building->address = $validatedData['address'];
            $building->country = $validatedData['country'];
            $building->map = $validatedData['map'];
            $building->status = $validatedData['status'];
            $building->save();
            return redirect()->route('admin.buildings')->with('success', 'Building updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.buildings')->with('error', 'Failed to update building: ' . $e->getMessage());
        }
    }
    public function deleteBuilding($id)
    {
        try {
            $building = Buildings::findOrFail($id);
            if ($building->status == 'active') {
                $building->status = 'inactive';
                $building->save();
            }
            return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.buildings')->with('error', 'Failed to delete building: ' . $e->getMessage());
        }
    }

    public function search(Request $request)
    {
        return view('search');
    }
}
