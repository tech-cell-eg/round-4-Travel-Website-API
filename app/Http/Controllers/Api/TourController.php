<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TourResource;
use App\Models\Tour;
use App\Traits\ApiResponse;

class TourController extends Controller
{

    use ApiResponse;

    public function index()
    {
        $tours = Tour::with(['destination', 'images'])
            ->orderByDesc('rating')
            ->paginate(20);

        if ($tours->isEmpty()) {
            return $this->errorResponse('No tours found.', 404);
        }

        $toursData = TourResource::collection($tours)->response()->getData(true);

        return $this->successResponse($toursData, 'Tours retrieved successfully.');
    }
}
