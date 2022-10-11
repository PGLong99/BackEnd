<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegistrationRequest;
use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ApiAuthController extends Controller
{
    public function Register(UserRegistrationRequest $request)
    {
        DB::beginTransaction();

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $payload = [
                'iss' => 'http://example.org',
                'aud' => 'http://example.com',
                'iat' => 1356999524,
                'nbf' => 1357000000,
                'id' => $user->id
            ];
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'User Registered Succesfully!',
                'data' => [
                    'accessToken' => JWT::encode($payload, config('jwt.key'), 'HS256'),
                ],
            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => 'User Registration Failed!'
            ], 500);
        }
    }
    public function authenticatedUserDetails()
    {
        return response()->json([
            'success' => true,
            'message' => 'Authenticated User Details.',
            'data' => [
                'user' => Auth::guard('api')->user(),
            ],
        ], 200);
    }
    public function login(UserLoginRequest $request)
    {
        if (User::where('email', '=', $request->email)->exists()) {
            $user = User::where('email', '=', $request->email)->first();
            $payload = [
                'iss' => 'http://example.org',
                'aud' => 'http://example.com',
                'iat' => 1356999524,
                'nbf' => 1357000000,
                'id' => $user->id
            ];
            if (Hash::check($request->password, $user->password)) {
                return response()->json([
                    'success' => true,
                    'message' => 'User Logged In Succesfully!',
                    'data' => [
                        'accessToken' => JWT::encode($payload, config('jwt.key'), 'HS256'),
                    ],
                ], 200);
            }

            return response()->json([
                'success' => true,
                'message' => 'Wrong User Credential!',
                'data' => null,
            ], 400);
        }

        return response()->json([
            'success' => false,
            'message' => 'No User With That Email Address!',
            'data' => null,
        ], 404);
    }
}
