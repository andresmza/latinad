<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ApiResponse;

    /**
     * Handle an authentication attempt.
     *
     * @param  \App\Http\Requests\AuthLoginRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(AuthLoginRequest $request)
    {
        $user = User::where('email', $request['email'])->first();

        if (!$user || !Hash::check($request['password'], $user->password)) {
            return $this->jsonResponse(Response::HTTP_UNAUTHORIZED, false, null, 'Invalid Credentials');
        }

        $accessToken = $user->createToken('authToken')->accessToken;

        return $this->jsonResponse(Response::HTTP_OK, true, ['access_token' => $accessToken], 'User logged in successfully.');
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();

        return $this->jsonResponse(Response::HTTP_OK, true, null, 'You have been successfully logged out.');
    }
}
