<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    public function index()
    {
        $version = Cache::get('settings_version', '1');
        $data = Cache::remember("settings.{$version}.all", 3600, function () {
            return Setting::allAsArray();
        });

        return response()->json([
            'success' => true,
            'data'    => $data,
        ]);
    }
}
