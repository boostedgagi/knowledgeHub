<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController
{
    /**
     * GET /categories/{id}
     * @return JsonResponse
     */
    public function show(int $id)
    {
        $category = DB::table('categories')->where('id', $id)->first();

        return response()->json(
            $category,
            200
        );
    }

    /**
     * POST /categories
     * @return void
     */
    public function create(Request $request){
        $category = DB::table('categories')->insert([
            'title' => $request->input('title')
        ]);
    }
}
