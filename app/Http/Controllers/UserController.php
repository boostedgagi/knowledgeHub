<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    /**
     * GET /users
     * @return JsonResponse
     */
    public function showAll()
    {
        return response()->json(
            DB::table('users')->get(),
            200
        );
    }

    /**
     * GET /users/{id}
     * @return JsonResponse
     */
    public function show(int $id)
    {
        $user = DB::table('users')->where('id', $id)->first();

        return response()->json(
            $user,
            200
        );
    }


    /**
     * POST /users
     */
    public function register(Request $request)
    {
        $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'password' => $request->password
        ]);

        return (new UserResource($user))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * PUT /users/{id}
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function update(int $id, Request $request)
    {
        $userToEdit = DB::table('users')->where('id', $id);
        $userToEdit->update($request->all());

        $userToEdit->update(['updatedAt' => Carbon::now()->format('Y-m-d H:i:s')]);

        return response()->json(
            $userToEdit,
            201
        );
    }

    /**
     * DELETE /users/{id}
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id)
    {
        DB::table('users')->delete($id);

        return response()->json(
            [],
            204
        );
    }
}
