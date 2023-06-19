<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CampResource;
use App\Models\Camp;
use Illuminate\Http\Request;

class CampController extends Controller
{
    public function show()
    {
        $camp = Camp::with('camp_benefit')->get();

        return CampResource::collection($camp);
    }
}
