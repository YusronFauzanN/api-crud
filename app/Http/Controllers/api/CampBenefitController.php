<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CampBenefitResource;
use App\Models\CampBenefit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CampBenefitController extends Controller
{
    public function show()
    {
        $camp_benefit = CampBenefit::with('camp')->get();

        return CampBenefitResource::collection($camp_benefit);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'camp_id' => ['required', 'max:255'],
            'benefit' => ['required', 'string', 'max:255']
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $camp = CampBenefit::create([
            'camp_id' => $request->camp_id,
            'name' => $request->benefit,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil ditambahkan!'
        ], 401);
    }
}
