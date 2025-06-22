<?php

namespace App\Http\Controllers;

use App\Http\Resources\TourResource;
use App\Models\Tour;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

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
        return $this->successResponse([
            'data' => TourResource::collection($tours),
            'links' => [
                'first' => $tours->url(1),
                'last' => $tours->url($tours->lastPage()),
                'prev' => $tours->previousPageUrl(),
                'next' => $tours->nextPageUrl(),
            ],
            'meta' => [
                'current_page' => $tours->currentPage(),
                'last_page' => $tours->lastPage(),
                'per_page' => $tours->perPage(),
                'total' => $tours->total(),
            ]
            ], 'Tours retrieved successfully.');
    }
}
