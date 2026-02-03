<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
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
        $tag = Tag::find($id);

        return response()->json(
            $tag,
            200
        );
    }

    /**
     * POST /tags
     */
    public function create(Request $request)
    {
        if (!$this->authorizeIfAdmin()) {
            return response()->json(['message' => 'Not authorized'], 403);
        }

        $post = Tag::Create([
            'title' => $request->input('title'),
        ]);

        return response()->json($post, 201);
    }

    private function authorizeIfAdmin()
    {
        $user = auth('api')->user();

        if (!$user || !$user->isAdministrator()) {
            return false;
        }
        return true;
    }

    /**
     * PUT /tags/{id}
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function update(int $id, Request $request)
    {
        if (!$this->authorizeIfAdmin()) {
            return response()->json(['message' => 'Not authorized'], 403);
        }

        $tagToEdit = Tag::find($id);
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
        if (!$this->authorizeIfAdmin()) {
            return response()->json(['message' => 'Not authorized'], 403);
        }

        Tag::destroy($id);

        return response()->json(
            [],
            204
        );
    }
}
