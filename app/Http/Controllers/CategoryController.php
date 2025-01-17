<?php
namespace App\Http\Controllers;

use App\Models\Buildings;
use Illuminate\Http\Request;
use App\Models\Rooms;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        // Nhận các tham số từ request
        $query = $request->get('query'); // Từ khóa tìm kiếm
        $type = $request->get('type');   // Loại phòng (Meeting/Conference Room)
        $startAt = $request->get('startAt'); // Ngày bắt đầu
        $endAt = $request->get('endAt');     // Ngày kết thúc
        $country = $request->get('country');     // Địa điểm
        $maxPeople = $request->get('maxPeople');   // Số người
        $maxTable = $request->get('maxTable');   // Số bàn
        $maxChair = $request->get('maxChair');   // Số ghế
        $furniture = $request->get('furniture'); // Furniture (ví dụ như loại bàn ghế)
        $minPrice = $request->get('minPrice'); // Giá thấp nhất
        $maxPrice = $request->get('maxPrice'); // Giá cao nhất
        $tag = $request->input('tag');

        $items = Buildings::distinct('country')->pluck('country');

        // Hashtags list
        $hashtags = ['#meeting_room', '#conference_room', '#ha_noi', '#da_nang', '#ho_chi_minh'];

        // Query cơ bản
        $queryBuilder = Rooms::query();

        $overallMinPrice = Rooms::min('price');
        $overallMaxPrice = Rooms::max('price');

        $filteredMinPrice = $queryBuilder->min('price') ?? $overallMinPrice;
        $filteredMaxPrice = $queryBuilder->max('price') ?? $overallMaxPrice;

        // Lọc theo từ khóa tìm kiếm
        if ($query) {
            $queryBuilder->where(function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%')
                    ->orWhere('tags', 'like', '%' . $query . '%')
                    ->orWhere('furniture', 'like', '%' . $query . '%')
                    ->orWhere('description', 'like', '%' . $query . '%');
            });
        }

        // Lọc theo hashtag (nếu có)
        if ($tag) {
            $queryBuilder->where('tags', 'like', '%' . urldecode($tag) . '%');
        }

        // Lọc theo loại phòng
        if ($type === 'meeting-room') {
            $queryBuilder->where('tags', 'like', '%Meeting room%');
        } elseif ($type === 'conference-room') {
            $queryBuilder->where('tags', 'like', '%Conference room%');
        }

        // Lọc theo ngày
        if ($startAt && $endAt) {
            $queryBuilder->whereDoesntHave('bookings', function ($q) use ($startAt, $endAt) {
                $q->where(function ($query) use ($startAt, $endAt) {
                    $query->whereBetween('startAt', [$startAt, $endAt])
                        ->orWhereBetween('endAt', [$startAt, $endAt])
                        ->orWhere(function ($query) use ($startAt, $endAt) {
                            $query->where('startAt', '<=', $startAt)
                                ->where('endAt', '>=', $endAt);
                        });
                });
            });
        }

        // Lọc theo địa điểm
        if ($country) {
            $queryBuilder->whereHas('building', function ($q) use ($country) {
                $q->where('country', $country);
            });
        }

        // Lọc theo số người, bàn, ghế
        if ($maxPeople) {
            $queryBuilder->where('maxPeople', '>=', $maxPeople);
        }
        if ($maxTable) {
            $queryBuilder->where('maxTable', '>=', $maxTable);
        }
        if ($maxChair) {
            $queryBuilder->where('maxChair', '>=', $maxChair);
        }

        // Lọc theo loại furniture (nếu có)
        if ($furniture) {
            $queryBuilder->where('furniture', 'like', '%' . $furniture . '%');
        }

        // Lọc theo giá
        if ($minPrice !== null && $maxPrice !== null) {
            $queryBuilder->whereBetween('price', [$minPrice, $maxPrice]);
        }

        // Xử lý yêu cầu AJAX
        if ($request->ajax()) {
            // Lấy tất cả các tham số từ request để thêm vào query
            $queryParams = $request->only([
                'query',
                'type',
                'startAt',
                'endAt',
                'country',
                'maxPeople',
                'maxTable',
                'maxChair',
                'furniture',
                'minPrice',
                'maxPrice',
                'tag'
            ]);

            $queryBuilder->where(function ($q) use ($queryParams) {
                // Áp dụng các bộ lọc
                if (!empty($queryParams['query'])) {
                    $q->where('name', 'like', '%' . $queryParams['query'] . '%');
                }
                if (!empty($queryParams['type'])) {
                    if ($queryParams['type'] === 'meeting-room') {
                        $q->where('tags', 'like', '%Meeting room%');
                    } elseif ($queryParams['type'] === 'conference-room') {
                        $q->where('tags', 'like', '%Conference room%');
                    }
                }
                if (!empty($queryParams['startAt'])) {
                    $q->whereDate('startAt', '>=', $queryParams['startAt']);
                }
                if (!empty($queryParams['endAt'])) {
                    $q->whereDate('endAt', '<=', $queryParams['endAt']);
                }
                if (!empty($queryParams['country']) && $queryParams['country'] !== 'Select place') {
                    $q->where('tags', 'like', '%' . $queryParams['country'] . '%');
                }
                if (!empty($queryParams['maxPeople']) && $queryParams['maxPeople'] !== 'Select people') {
                    $q->where('maxPeople', '>=', $queryParams['maxPeople']);
                }
                if (!empty($queryParams['maxTable']) && $queryParams['maxTable'] !== 'Select table') {
                    $q->where('maxTable', '>=', $queryParams['maxTable']);
                }
                if (!empty($queryParams['maxChair']) && $queryParams['maxChair'] !== 'Select chair') {
                    $q->where('maxChair', '>=', $queryParams['maxChair']);
                }
                if (!empty($queryParams['furniture'])) {
                    $q->where('furniture', 'like', '%' . $queryParams['furniture'] . '%');
                }
                if (!empty($queryParams['minPrice']) && !empty($queryParams['maxPrice'])) {
                    $q->whereBetween('price', [
                        $queryParams['minPrice'],
                        $queryParams['maxPrice']
                    ]);
                }
                if (!empty($queryParams['hashtags'])) {
                    $q->where('tags', 'like', '%' . $queryParams['hashtags'] . '%');
                }
            });

            // Phân trang kết quả
            $products = $queryBuilder->paginate(16)->appends($request->query());

            // Render view cho sản phẩm và phân trang
            $productsHtml = view('components.category-product-grid', compact('products'))->render();
            $paginationHtml = view('components.category-product-pagination', compact('products'))->render();

            return response()->json([
                'productsHtml' => $productsHtml,
                'paginationHtml' => $paginationHtml,
            ]);
        }

        // Phân trang cho yêu cầu không phải AJAX
        $products = $queryBuilder->paginate(16)->appends($request->query());

        // Trả về view với dữ liệu
        return view('categories', [
            'products' => $products,
            'items' => $items,
            'hashtags' => $hashtags,
            'minPrice' => $overallMinPrice, // Giá trị tối thiểu toàn bộ
            'maxPrice' => $overallMaxPrice, // Giá trị tối đa toàn bộ
            'filteredMinPrice' => $filteredMinPrice, // Giá trị tối thiểu theo bộ lọc
            'filteredMaxPrice' => $filteredMaxPrice,
            'filters' => $request->all(), // Truyền toàn bộ dữ liệu từ request
            'selectedTag' => $tag, // Tag được chọn (nếu có)
        ]);
    }
}
