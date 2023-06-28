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

    public function getCampBenefit(Request $request)
    {
        $camp_benefit = CampBenefit::with('camp')->find($request->camp_id);

        return new CampBenefitResource($camp_benefit);
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
        ], 201);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'camp_id' => ['max:255'],
            'benefit' => ['string', 'max:255']
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $camp_benefit = CampBenefit::find($request->camp_id);

        if(!$camp_benefit){
            return response()->json([
                'success' => true,
                'message' => 'Data tidak ada!'
            ]);
        }

        $camp_benefit->name = $request->benefit;
        $camp_benefit->save();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diubah!'
        ]);
    }

    public function destroy(Request $request)
    {
        // Find users photo
        $camp_benefit = CampBenefit::find($request->camp_id);

        if (!$camp_benefit) {
            return response()->json([
                'message' => 'Data Not Found!'
            ],404);
        }

        // Delete photo
        $camp_benefit->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus!'
        ]);
    }
}
