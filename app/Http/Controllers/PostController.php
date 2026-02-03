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
        $posts = Post::with(['category','comment'])->get();

        return PostResource::collection($posts)
            ->response()
            ->setStatusCode(201);
    }

    /**
     * GET /posts/{id}
     * @return JsonResponse
     */
    public function show(int $id)
    {
        $post = Post::with(['category','comment'])->find($id);

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
            'title' => $request->input('title'),
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
        $postToEdit = Post::find($id);
        $postToEdit->update($request->all());

        $postToEdit->update(['updatedAt' => Carbon::now()->format('Y-m-d H:i:s')]);


        return (new PostResource($postToEdit))
            ->response()
            ->setStatusCode(201);
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
