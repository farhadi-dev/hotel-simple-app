<?php

namespace App\Services;

use App\DTO\AuthRegisterDTO;
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

    public function getAllUsersWithReservation()
    {
        return $this->userRepository->all();
    }
    public function getUserById($id)
    {
        return $this->userRepository->find($id);
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
