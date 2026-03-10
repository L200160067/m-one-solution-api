<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PartnerResource;
use App\Models\Partner;
use Illuminate\Support\Facades\Cache;

class PartnerController extends Controller
{
    public function index()
    {
        $data = Cache::tags(['partners'])->remember('partners.index', 3600, function () {
            return Partner::with('media')->orderBy('order_column')->get();
        });

        return PartnerResource::collection($data);
    }
}
