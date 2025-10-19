<?php

namespace App\Http\Controllers;

use App\DTO\AuthRegisterDTO;
use App\Http\Requests\AuthRegisterRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     */
    /**
     * @SWG\Post(
     *     path="/register",
     *     summary="register User",
     *     tags={"Users"},
     *     @SWG\Response(response=201, description="created user"),
     *     @SWG\Response(response=400, description="Invalid request")
     * )
     */

    public function register(AuthRegisterRequest $request, UserService  $userService)
    {
        $data = $request->validated();

        $user = $userService->createUser(AuthRegisterDTO::fromRequest($data));

        return response()->json([
            'message' => 'User registered successfully!',
            'user' => $user
        ], 201);
    }
    public function login(Request $request)
    {
        $credentials = $request->only('phone', 'password');

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
