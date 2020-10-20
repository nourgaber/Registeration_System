<?php
namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRepository
{
    public function createUser($name, $email, $password)
    {
        $user = new User;
        $user->name = $name;
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->verifyToken = Str::random(25);
        $user->save();
        return $user;
    }
    public function getUserByEmail($email)
    {
        return User::where('email', $email)->get();

    }
    
    public function updateUserById($userId, array $options)
    {
        $user = User::where('id', $userId)->update($options);
        return $user;
    }

}