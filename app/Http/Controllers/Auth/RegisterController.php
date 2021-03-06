<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRegisterationRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\AdminService;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    protected $userService;
    protected $adminService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserService $userservice, AdminService $adminService)
    {
        $this->userService = $userservice;
        $this->adminService = $adminService;
        $this->middleware('guest');
        $this->middleware('guest:admin');

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return $this->userService->createUser($data['name'], $data['email'], $data['password']); 
    }

    public function showAdminRegisterForm()
    {
        return view('auth.register', ['url' => 'admin']);
    }

    protected function createAdmin(AdminRegisterationRequest $request)
    {
        $admin =  $this->adminService->createAdmin($request['name'], $request['email'], $request['password']); 
        return redirect()->intended('login/admin');
    }
}
