<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Http\Resources\TestimonialResource;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->take(5)->get();

        return TestimonialResource::collection($testimonials);
    }
}
