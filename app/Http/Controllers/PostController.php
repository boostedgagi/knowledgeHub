<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
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
        $post = Post::with('category')->find($id);

        return (new PostResource($post))
            ->response()
            ->setStatusCode(201);
    }


    /**
     * POST /posts
     */
    public function post(Request $request)
    {
        $post = Post::create([
            'postContent' => $request->input('postContent'),
            'categoryId' => $request->input('categoryId'),
            'userId' => $request->input('userId'),
        ]);

        return (new PostResource($post))
        ->response()
        ->setStatusCode(201);
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
