<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController
{

    /**
     * GET /comments
     * @return JsonResponse
     */
    public function showAll()
    {
        if (!$this->isAuthenticated()) {
            return response()->json([
                'Message' => 'Not Authenticated'
            ], 403);
        }

        return response()->json(
            Comment::all(),
            200
        );
    }

    private function isAuthenticated()
    {
        $user = auth('api')->user();

        if (!$user) {
            return false;
        }
        return true;
    }

    /**
     * GET /comments/{id}
     * @return JsonResponse
     */
    public function show(int $id)
    {
        if (!$this->isAuthenticated()) {
            return response()->json([
                'Message' => 'Not Authenticated'
            ], 403);
        }

        $comment = Comment::with(['user', 'post'])->findOrFail($id);
//        dd($comment,$comment->user, $comment->post);
        return (new CommentResource($comment))
            ->response()
            ->setStatusCode(200);
    }

    /**
     * POST /comments
     */
    public function create(Request $request)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json([], 403);
        }

        $comment = Comment::create([
            'content' => $request->input('content'),
            'userId' => $user->id,
            'postId' => $request->input('postId')
        ]);

        return response()->json($comment, 201);
    }

    /**
     * PUT /comments/{id}
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function update(int $id, Request $request)
    {
        if (!$this->isAuthenticated()) {
            return response()->json([
                'Message' => 'Not Authenticated'
            ], 403);
        }

        $commentToEdit = Comment::find($id);
        $commentToEdit->update($request->all());

        $commentToEdit->update(['updatedAt' => Carbon::now()->format('Y-m-d H:i:s')]);

        return response()->json(
            $commentToEdit,
            201
        );
    }

    /**
     * DELETE /comments/{id}
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id)
    {
        Comment::destroy($id);

        return response()->json(
            [],
            204
        );
    }
}
