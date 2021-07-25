<?php

namespace App\Http\Controllers\Api\Main;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Category::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'min:5', 'max:255'],
        ]);

        Category::create($data);

        return response()->json([
            'message' => 'دسته بندی با موفقیت ایجاد شد'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $cat = Category::findOrFail($id);

        return response()->json([
            'data' => $cat
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => ['required', 'min:5', 'max:255'],
        ]);

        $cat = Category::find($id);

        if (!$cat) {
            return response()->json([
                'message' => 'دسته بندی با آیدی مورد نظر پیدا نشد'
            ]);
        }

        $cat->update($data);
        return response()->json([
            'message' => 'دسته بندی با موفقیت بروزرسانی شد'
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
        $category = Category::findOrFail($id);
        $category->delete();
        return response()->json([
            'message' => 'دسته بندی با موفقیت حذف شد'
        ]);
    }
}
