<?php

namespace App\Http\Controllers\Api\Main;

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
        $advertises = Advertise::paginate(10);
        $advertises->load(['category', 'fields', 'images']);

        return response()->json([
            'data' => $advertises
        ], 200);
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
            'data' => $advertise->load(['category', 'fields', 'images'])
        ]);
    }




}
