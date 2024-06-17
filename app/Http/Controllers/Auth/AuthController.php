<?php

namespace App\Http\Controllers\Auth;

// ===================================================>> Core Library
use Illuminate\Http\Request; // For Getting requested Payload from Client
use Illuminate\Http\Response; // For Responsing data back to Client

// ===================================================>> Third Party Library fuck
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

// ===================================================>> Custom Library
use App\Http\Controllers\MainController;
use App\Models\Type;
use App\Models\User;


class AuthController extends MainController
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt.verify', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $req){

        // ===>> Data Validation
        $this->validate($req,
            [
                'username' => ['required'],
                'password' => 'required|min:6|max:20'
            ],
            [
                'username.required' => 'Please input your Email or Phone number!',
                'password.required' => 'Please input your Password!',
                'password.min'      => 'Password must be greater than or equal to 6',
                'password.max'      => 'Password must be less than or equal to 20',
            ]
        );

        // ===>> Check Login
        $credentials = array(
            'phone'             =>  $req->username,
            'password'          =>  $req->password,
            'is_active'         =>  1,
            'deleted_at'        =>  null,
        );

        try {

            // ===>> Set JWT Token Time To Live
            JWTAuth::factory()->setTTL(1200); //1200 នាទី

            // ===>> Credentails comparation by JWTAuth in DB using table user
            $token = JWTAuth::attempt($credentials);

            // ===>> Check if Token is not valid
            if (!$token) { // Yes

                // ===>> Failed Response Back to Client due to invalide username or password
                return response()->json([
                    'status'    => 'error',
                    'message'   => 'Invalid username or password.'
                ], Response::HTTP_UNAUTHORIZED);

            }

        } catch (JWTException $e) {

            // ===>> Failed Response Back to Client due to Server Errro
            return response()->json([
                'status'    => 'Failed!',
                'message'   => 'Cannot Login',
                'error'     => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);

        }

        // ==>> Get Data from Auth App for User object
        $user = auth()->user();

        // ===>> User Format
        $dataUser = [
            'id'        => $user->id,
            'name'      => $user->name,
            'email'     => $user->email,
            'avatar'    => $user->avatar,
            'phone'     => $user->phone
        ];

        // ====> Check Role
        $role = '';
        if ($user->type_id == 2) { //
            $role = 'Staff';
        } else {
            $role = 'Admin';
        }

        // ===>> Success Response Back to Client
        return response()->json([
            'access_token'  => $token,
            'token_type'    => 'bearer',
            'expires_in'    => JWTAuth::factory()->getTTL() / 60 . ' hours',
            'user'          => $dataUser,
            'role'          => $role
        ], Response::HTTP_OK);

    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        // ===>> Make Application Logout
        auth()->logout();

        // ===>> Success Response Back to Client
        return response()->json(['message' => 'Successfully logged out'], 200);
    }


}
