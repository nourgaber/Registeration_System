<?php
namespace App\Repositories;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminRepository
{
    /**
     * @param $name
     * @param $email
     * @param $password
     *
     * @return \App\Models\Admin
     */
    public function createAdmin($name, $email, $password)
    {
        $admin = new Admin;
        $admin->name = $name;
        $admin->email = $email;
        $admin->password = Hash::make($password);
        $admin->verifyToken = Str::random(25);
        $admin->save();
        return $admin;
    }

    /**
     * @param       $adminId
     * @param array $options
     *
     * @return mixed
     */
    public function updateAdminById($adminId, array $options)
    {
        $admin = Admin::where('id', $adminId)->update($options);
        return $admin;
    }

}
