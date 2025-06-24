<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Http\Resources\ActivityResource;
use App\Traits\ApiResponse;

class ActivityController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $activities = Activity::with('destination')->paginate(10);

        if ($activities->isEmpty()) {
            return $this->errorResponse('No activities found.', 404);
        }
        $activitiesData = ActivityResource::collection($activities)->response()->getData(true);

        return $this->successResponse(
            $activitiesData,
            'Activities retrieved successfully.'
        );
    }

    public function byDestination($destinationId)
    {
        $activities = Activity::where('destination_id', $destinationId)
            ->with('destination')
            ->paginate(10);

        if ($activities->isEmpty()) {
            return $this->errorResponse('No activities found for this destination.', 404);
        }

        $activitiesData = ActivityResource::collection($activities)->response()->getData(true);

        return $this->successResponse(
            $activitiesData,
            'Activities in destination retrieved successfully.'
        );
    }

    public function show($id)
    {
        $activity = Activity::with('destination')->findOrFail($id);

        if (!$activity) {
            return $this->errorResponse('Activity not found.', 404);
        }

        return $this->successResponse(
            new ActivityResource($activity),
            'Activity details retrieved successfully.'
        );
    }
}
