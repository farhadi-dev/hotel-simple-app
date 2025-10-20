<?php

namespace App\Http\Controllers;

use App\DTO\AuthRegisterDTO;
use App\Http\Requests\AuthRegisterRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    /**
     * Get a JWT via given credentials.
     *
     * @param AuthRegisterRequest $request
     * @param UserService $userService
     * @return JsonResponse
     * @SWG\Post(
     *     path="/register",
     *     summary="register User",
     *     tags={"Users"},
     *     @SWG\Response(response=201, description="created user"),
     *     @SWG\Response(response=400, description="Invalid request")
     * )
     */
    public function register(AuthRegisterRequest $request, UserService $userService): JsonResponse
    {
        $data = $request->validated();

        $user = $userService->createUser(AuthRegisterDTO::fromRequest($data));

        return response()->json([
            'message' => 'User registered successfully!',
            'user' => $user
        ], 201);
    }

    /**
     * Login the user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->only('phone', 'password');

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return UserService::respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        return UserService::respondWithToken(auth()->refresh());
    }

}
