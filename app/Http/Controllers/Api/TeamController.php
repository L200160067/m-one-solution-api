<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TeamMemberResource;
use App\Models\TeamMember;
use Illuminate\Support\Facades\Cache;

class TeamController extends Controller
{
    public function index()
    {
        $data = Cache::tags(['team'])->remember('team.index', 3600, function () {
            return TeamMember::with('media')->orderBy('order_column')->get();
        });

        return TeamMemberResource::collection($data);
    }
}
