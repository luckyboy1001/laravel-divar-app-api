<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Advertise;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdvertiseImageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request)
    {
        $request->validate([
            'alt' => ['required', 'max:512'],
            'image' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg', 'max:1024'],
            'advertise_id' => ['required']
        ]);

        $advertise = Advertise::find($request->advertise_id);
        if (!$advertise) {
            return response()->json([
                'message' => 'آگهی پیدا نشد',
            ], 404);
        }


        $image = $request->image;

        $filenameWithExt = $image->getClientOriginalName();
        //Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get just ext
        $extension = $image->getClientOriginalExtension();
        // Filename to store
        $fileNameToStore = $filename.'_'.time().'.'.$extension;

        $uploadImage = $image->storeAs('public/advertises', $fileNameToStore);

        if (!$uploadImage) {
            return response()->json([
                'message' => 'آپلود تصویر با شکست مواجه شد',
            ], 422);
        }

        $image = $advertise->images()->create([
            "alt" => $request->alt,
            "url" => 'advertises/' . $fileNameToStore
        ]);

        return response()->json([
            'message' => 'تصویر با موفقیت آپلود شد',
            'data' => $image
        ], 201);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $id)
    {
        $request->validate([
            'advertise_id' => ['required']
        ]);

        $advertise = Advertise::find($request->advertise_id);

        if (!$advertise) {
            return response()->json([
                'message' => 'آیدی آگهی نامعتبر است'
            ]);
        }

        $advertise->images()->find($id)->delete();

        return response()->json([
            'message' => 'تصویر با موفقیت حذف شد'
        ]);
    }
}
