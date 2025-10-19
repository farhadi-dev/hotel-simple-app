<?php

namespace App\DTO;

use Illuminate\Foundation\Http\FormRequest;

class AuthRegisterDTO
{
    public $name;
    public $family;
    public $phone;
    public $password;

    public static function fromRequest(array $data): AuthRegisterDTO
    {
        $dto = new self();
        $dto->name = $data['name'];
        $dto->family = $data['family'];
        $dto->phone = $data['phone'];
        $dto->password = $data['password'];
        return $dto;
    }
}
