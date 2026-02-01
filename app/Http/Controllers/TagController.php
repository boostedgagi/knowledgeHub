<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TagController
{

    /**
     * GET /tags
     * @return JsonResponse
     */
    public function showAll()
    {
        return response()->json(
            DB::table('tags')->get(),
            200
        );
    }

    /**
     * GET /tags/{id}
     * @return JsonResponse
     */
    public function show(int $id)
    {
        $post = DB::table('tags')->where('id', $id)->first();

        return response()->json(
            $post,
            200
        );
    }


    /**
     * POST /tags
     */
    public function post(Request $request)
    {
        $post = DB::table('posts')->insert([
            'title' => $request->input('title'),
        ]);

        return response()->json($post, 201);
    }

    /**
     * PUT /tags/{id}
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function update(int $id, Request $request)
    {
        $tagToEdit = DB::table('tags')->where('id', $id);
        $tagToEdit->update($request->all());

        $tagToEdit->update(['updatedAt' => Carbon::now()->format('Y-m-d H:i:s')]);

        return response()->json(
            $tagToEdit,
            201
        );
    }

    /**
     * DELETE /tags/{id}
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id)
    {
        DB::table('tags')->delete($id);

        return response()->json(
            [],
            204
        );
    }
}
