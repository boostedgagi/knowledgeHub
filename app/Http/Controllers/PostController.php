<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController
{

    /**
     * GET /posts
     * @return JsonResponse
     */
    public function showAll()
    {
        return response()->json(
            DB::table('posts')->get(),
            200
        );
        //Need to make a pagination here,
        //or integrate it in search
    }

    /**
     * GET /posts/{id}
     * @return JsonResponse
     */
    public function show(int $id)
    {
        $post = DB::table('posts')->where('id', $id)->first();

        return response()->json(
            $post,
            200
        );
    }


    /**
     * POST /posts
     */
    public function post(Request $request)
    {
        $post = DB::table('posts')->insert([
            'content' => $request->input('content'),
            'categoryId' => $request->input('categoryId'),
            'userId' => $request->input('userId'),
        ]);

        return response()->json($post, 201);
    }

    /**
     * PUT /posts/{id}
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function update(int $id, Request $request)
    {
        $postToEdit = DB::table('posts')->where('id', $id);
        $postToEdit->update($request->all());

        $postToEdit->update(['updatedAt' => Carbon::now()->format('Y-m-d H:i:s')]);

        return response()->json(
            $postToEdit,
            201
        );
    }

    /**
     * DELETE /posts/{id}
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id)
    {
        DB::table('posts')->delete($id);

        return response()->json(
            [],
            204
        );
    }
}
