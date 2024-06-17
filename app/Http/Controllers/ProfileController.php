<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;

use Tymon\JWTAuth\Facades\JWTAuth; // Get Current Logged User


class ProfileController extends MainController
{
    public function view(){

        // ===>> Get current logged user by token
        $auth = JWTAuth::parseToken()->authenticate();

        // ===>> Get user Data from DB;
        $user = User::select('id', 'name', 'phone', 'email', 'avatar')->where('id', $auth->id)->first();

        // ===>> Success Response Back to Client
        return response()->json($user, Response::HTTP_OK);

    }
}
