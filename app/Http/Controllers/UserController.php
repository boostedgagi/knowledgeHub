<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

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
        $user = DB::table('users')->insert([
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ]);qw

        return response()->json($user, 201);
    }
}
