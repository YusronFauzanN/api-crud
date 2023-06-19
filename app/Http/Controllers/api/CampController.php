<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CampResource;
use App\Models\Camp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CampController extends Controller
{
    public function show()
    {
        $camp = Camp::with('camp_benefit')->get();

        return CampResource::collection($camp);
    }

    public function getCamp(Request $request)
    {
        $camp = Camp::with('camp_benefit')->find($request->camp_id);

        return new CampResource($camp);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255'],
            'price' => ['required', 'int'],
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $camp = Camp::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'price' => $request->price,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil ditambahkan!'
        ], 201);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => [ 'string', 'max:255'],
            'slug' => [ 'string', 'max:255'],
            'price' => [ 'int', 'max:255'],
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $camp = Camp::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'price' => $request->price,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil ditambahkan!'
        ]);
    }

    public function destroy(Request $request)
    {
        // Find users photo
        $camp = Camp::find($request->camp_id);

        if (!$camp) {
            return response()->json([
                'message' => 'Data Not Found!'
            ],404);
        }

        // Delete photo
        $camp->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus!'
        ]);
    }
}
