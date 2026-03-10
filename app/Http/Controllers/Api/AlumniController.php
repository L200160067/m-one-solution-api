<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AlumniResource;
use App\Models\Alumni;
use Illuminate\Support\Facades\Cache;

class AlumniController extends Controller
{
    public function index()
    {
        $version = Cache::get('alumni_version', '1');
        $data = Cache::remember("alumni.{$version}.index", 3600, function () {
            return Alumni::with('media')
                ->orderByDesc('batch_period')
                ->orderBy('order_column')
                ->get()
                ->groupBy('batch_period');
        });

        return response()->json([
            'success' => true,
            'data'    => $data->map(fn ($batch, $period) => [
                'batch_period' => $period,
                'members'      => AlumniResource::collection($batch)->resolve(),
            ])->values(),
        ]);
    }
}
