<?php

namespace App\Http\Controllers;

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
        return response()->json(
            DB::table('comments')->get(),
            200
        );
    }

    /**
     * GET /comments/{id}
     * @return JsonResponse
     */
    public function show(int $id)
    {
        $comment = DB::table('comments')->where('id', $id)->first();

        return response()->json(
            $comment,
            200
        );
    }


    /**
     * POST /comments
     */
    public function post(Request $request)
    {
        $comment = DB::table('comments')->insert([
            'content' => $request->input('content'),
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
        $commentToEdit = DB::table('comments')->where('id', $id);
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
        DB::table('comments')->delete($id);

        return response()->json(
            [],
            204
        );
    }
}
