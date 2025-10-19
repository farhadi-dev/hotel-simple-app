<?php
namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function all()
    {
        return User::query()->with('reservations')->get();
    }
    public function find($id)
    {
        return User::query()->with('reservations')->findOrFail($id);
    }
    public function create(array $data)
    {
        return User::query()->create($data);
    }
    public function update(array $data, $id)
    {
        $user = User::query()->findOrFail($id);
        $user->update($data);
        return $user;
    }
    public function delete($id)
    {
        $user = User::query()->findOrFail($id);
        $user->delete();
        return $user;
    }
}
