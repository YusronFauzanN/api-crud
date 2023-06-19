<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CampBenefitResource;
use App\Models\CampBenefit;
use Illuminate\Http\Request;

class CampBenefitController extends Controller
{
    public function show()
    {
        $camp_benefit = CampBenefit::with('camp')->get();

        return CampBenefitResource::collection($camp_benefit);
    }
}
