<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdvertiseRequest;
use App\Models\Advertise;
use Illuminate\Http\Request;

class AdvertiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $advertises = auth()->user()->advertises;
        $advertises->load(['category', 'fields']);

        return response()->json([
            'data' => $advertises
        ], 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreAdvertiseRequest $request): \Illuminate\Http\JsonResponse
    {
        $advertise = auth()->user()->advertises()->create($request->validated());

        if (!$advertise) {
            return response()->json([
                'message' => 'advertise creation failed'
            ], 422);
        }

        return response()->json([
            'data' => $advertise->load('category'),
            'message' => 'advertise created successfully'
        ], 201);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): \Illuminate\Http\JsonResponse
    {
        $advertise = Advertise::find($id);

        if (!$advertise) {
            return response()->json([
                'message' => 'advertise not found'
            ]);
        }

        return response()->json([
            'message' => 'advertise found',
            'data' => $advertise->load('category')
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Advertise $advertise): \Illuminate\Http\JsonResponse
    {
        $data = $request->validate([
            'title' => 'max:255',
            'description' => 'max:10000',
            'price' => 'max:10000000',
            'category_id' => 'numeric'
        ]);

        if (!$advertise) {
            return response()->json([
                'message' => 'advertise not found on this user',
            ]);
        }

        if (!$advertise->update($data)) {
            return response()->json([
                'message' => 'advertise update process failed',
                'data' => $advertise
            ]);
        }

        return response()->json([
            'message' => 'advertise updated successfully',
            'data' => $advertise
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $advertise = auth()->user()->advertises()->find($id);
        if (!$advertise) {
            return response()->json([
                'message' => 'advertise not found with this user'
            ]);
        }

        if (!$advertise->delete()) {
            return response()->json([
                'message' => 'destroy process failed'
            ]);
        }
        return response()->json([
            'message' => 'destroy process was successful'
        ]);
    }
}
