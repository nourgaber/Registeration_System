<?php
namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UserRepository
{
    public function createUser($name, $email, $password)
    {
        $user = new User;
        $user->name = $name;
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->verifyToken = Str::random(25);
        $user->last_login_at = Carbon::now()->toDateTimeString();
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
    public function getUnactiveUsers(){
        return User::where('last_login_at', '<', Carbon::now()->subMonth(3)->toDateTimeString())->get();
    }

    public function deleteUsersByIds(array $ids){
        User::whereIn('id', $ids)->delete();
    }
}