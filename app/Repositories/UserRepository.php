<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UserRepository
{
    /**
     * @param $name
     * @param $email
     * @param $password
     *
     * @return \App\Models\User
     */
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

    /**
     * @param $email
     *
     * @return mixed
     */
    public function getUserByEmail($email)
    {
        return User::where('email', $email)->get();

    }

    /**
     * @param $userId
     *
     * @return mixed
     */
    public function getUserById($userId)
    {
        return User::where('id', $userId)->get();
    }

    /**
     * @param       $userId
     * @param array $options
     *
     * @return mixed
     */
    public function updateUserById($userId, array $options)
    {
        $user = User::where('id', $userId)->update($options);
        return $user;
    }

    /**
     * @return mixed
     */
    public function getUnactiveUsers()
    {
        return User::where('last_login_at', '<', Carbon::now()->subMonth(3)->toDateTimeString())->get();
    }

    /**
     * @param array $ids
     */
    public function deleteUsersByIds(array $ids)
    {
        User::whereIn('id', $ids)->delete();
    }


}
