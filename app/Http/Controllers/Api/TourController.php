<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TourResource;
use App\Models\Category;
use App\Models\Tour;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class TourController extends Controller
{

    use ApiResponse;

    public function index(Request $request)
    {
        $filters = $request->only([
            'category', 'type', 'price_min', 'price_max', 'duration', 'language', 'rating'
        ]);

        $tours = Tour::with(['destination', 'category', 'images'])
            ->filter($filters)
            ->orderByDesc('rating')
            ->paginate(20);

        if ($tours->isEmpty()) {
            return $this->errorResponse('No tours found.', 404);
        }

        $toursData = TourResource::collection($tours)->response()->getData(true);

        return $this->successResponse($toursData, 'Tours retrieved successfully.');
    }

    public function show($slug)
    {
        $tour = Tour::with(['destination', 'images'])
            ->where('slug', $slug)
            ->first();

        if (!$tour) {
            return $this->errorResponse('Tour not found.', 404);
        }

        $tourData = new TourResource($tour);

        return $this->successResponse($tourData, 'Tour retrieved successfully.');
    }

    public function categories()
    {
        $categories = Category::select('slug', 'name')->get();

        if ($categories->isEmpty()) {
            return $this->errorResponse('No categories found.', 404);
        }

        return $this->successResponse($categories, 'Categories retrieved successfully.');
    }
}
