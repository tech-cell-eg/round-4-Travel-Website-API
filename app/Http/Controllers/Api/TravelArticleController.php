<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TravelArticleResource;
use App\Models\TravelArticle;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class TravelArticleController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the travel articles.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function index(Request $request)
    {
        $travelArticles = TravelArticle::paginate();

        if ($travelArticles->isEmpty()) {
            return $this->errorResponse('No travel articles found.', 404);
        }

        $articles = TravelArticleResource::collection($travelArticles)->response()->getData(true);

        return $this->successResponse($articles, 'Travel articles retrieved successfully.');
    }
}
