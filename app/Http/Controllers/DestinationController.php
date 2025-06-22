<?php

namespace App\Http\Controllers;

use App\Http\Resources\DestinationResource;
use App\Models\Destination;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    use ApiResponse;

    public function trending ()
    {
        $destinations = Destination::trending(10)->get();

        if ($destinations->isEmpty()) {
            return $this->errorResponse(null, 'No trending destinations found', 404);
        }

        return $this->successResponse(DestinationResource::collection($destinations), 'Trending destinations retrieved successfully');
    }
}
