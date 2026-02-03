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

        $user = User::with('posts')->find($id);

        return (new UserResource($user))
            ->response()
            ->setStatusCode(200);

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
        $userToEdit = User::find($id);
        $userToEdit->update($request->all());

        if($request->roles){
            $userToEdit->update(['roles' => $request->roles]);
        }

        $userToEdit->update(['updatedAt' => Carbon::now()->format('Y-m-d H:i:s')]);

        return response()->json(
            $userToEdit,
            201
        );
    }

    /**
     * PATCH /change_user_role/{id}
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function changeRole(int $id, Request $request)
    {
        $userToEdit = User::find($id);
//        if($request->roles){
//            $userToEdit->update(['roles' => $request->roles]);
//        }

        try {
            $userToEdit->update(['roles' => $request->input('roles')]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }

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
