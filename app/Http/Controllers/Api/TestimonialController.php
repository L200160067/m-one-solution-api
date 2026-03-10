<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TestimonialResource;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Cache;

class TestimonialController extends Controller
{
    public function index()
    {
        $data = Cache::tags(['testimonials'])->remember('testimonials.index', 3600, function () {
            return Testimonial::with('media')->active()->latest()->get();
        });

        return TestimonialResource::collection($data);
    }
}
