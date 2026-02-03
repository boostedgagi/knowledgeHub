<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Roles;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class CategoryController
{
    /**
     * GET /categories/{id}
     * @return JsonResponse
     */
    public function show(int $id)
    {
        $category = Category::find($id);

        return response()->json(
            $category,
            200
        );
    }

    /**
     * POST /categories
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        if (!$this->authorizeIfAdmin()) {
            return response()->json(['message' => 'Not authorized'], 403);
        }

        $category = Category::create([
            'title' => $request->input('title')
        ]);

        return response()->json(
            $category,
            201
        );
    }

    /**
     * PUT /categories/{id}
     * @return JsonResponse
     */
    public function update(int $id, Request $request)
    {
        if (!$this->authorizeIfAdmin()) {
            return response()->json(['message' => 'Not authorized'], 403);
        }

        $categoryToEdit = Category::find($id);
        $categoryToEdit->update($request->all());

        $categoryToEdit->update(['updatedAt' => Carbon::now()->format('Y-m-d H:i:s')]);

        return response()->json(
            $categoryToEdit,
            201
        );
    }

    /**
     * DELETE /categories/{id}
     * @param int $
     * @return JsonResponse
     */
    public function delete(int $id)
    {
        if (!$this->authorizeIfAdmin()) {
            return response()->json(['message' => 'Not authorized'], 403);
        }

        DB::table('categories')->delete($id);

        return response()->json(
            [],
            204
        );
    }

    private function authorizeIfAdmin()
    {
        $user = auth('api')->user();

        if (!$user || !$user->isAdministrator()) {
            return false;
        }
        return true;
    }
}
