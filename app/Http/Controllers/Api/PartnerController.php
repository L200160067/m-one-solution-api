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
        $version = Cache::get('partners_version', '1');
        $data = Cache::remember("partners.{$version}.index", 3600, function () {
            return Partner::with('media')->orderBy('order_column')->get();
        });

        return PartnerResource::collection($data);
    }
}
