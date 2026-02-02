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
        $category = DB::table('categories')->where('id', $id)->first();

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
        $user = auth('api')->user();

        if (!$user || !$user->isAdministrator()) {
            return response()->json(
                ['message' => 'Not authorized'],
                401
            );
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
        $categoryToEdit = DB::table('categories')->where('id', $id);
        $categoryToEdit->update($request->all());

        $categoryToEdit->update(['updatedAt' => Carbon::now()->format('Y-m-d H:i:s')]);

        return response()->json(
            $categoryToEdit->first(),
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
        DB::table('categories')->delete($id);

        return response()->json(
            [],
            204
        );
    }
}
