<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    public function index()
    {
        $data = Cache::remember('settings.all', 3600, function () {
            return Setting::allAsArray();
        });

        return response()->json([
            'success' => true,
            'data'    => $data,
        ]);
    }
}
