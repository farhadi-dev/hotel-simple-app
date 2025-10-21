<?php

namespace App\Services;

use App\DTO\AuthRegisterDTO;
use App\Models\Hotel;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserService
{
    protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function getAllUsersWithReservation()
    {
        return $this->userRepository->getAll();
    }
    public function getUserById($id)
    {
        return $this->userRepository->getById($id);
    }
    public function createUser(AuthRegisterDTO $dto)
    {
        return $this->userRepository->create([
            'name' => $dto->name,
            'family' => $dto->family,
            'phone' => $dto->phone,
            'password' => Hash::make($dto->password),
        ]);
    }
    public function loginUser(array $data)
    {
        if(!$token = Auth::attempt($data))
        {
            return null;
        }
        return $token;
    }
    public function updateUser($id, array $data)
    {
        return $this->userRepository->update($id, $data);
    }
    public function deleteUser($id)
    {
        return $this->userRepository->delete($id);
    }
}
