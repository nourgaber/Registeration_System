<?php
namespace App\Http\Controllers;

use App\Http\Requests\AdminRegisterationRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRegisterationRequest;
use App\Models\User;
use App\Services\AdminService;
use App\Services\UserService;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $userService;
    protected $adminService;

    public function __construct(UserService $userservice, AdminService $adminService)
    {
        $this->userService = $userservice;
        $this->adminService = $adminService;
        $this->middleware('auth:api')->except('login', 'register','adminRegister');
        // $this->middleware('auth:admin-api')->except('login', 'adminRegister');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(UserRegisterationRequest $request): JsonResponse
    {
        $user = $this->userService->createUser($request->name, $request->email, $request->password);
        $credentials = $request->only('email', 'password');
        $token = Auth::guard('api')->attempt($credentials);
        if ($token) {
            return $this->respondWithToken($token);
        }
    }
    public function adminRegister(AdminRegisterationRequest $request): JsonResponse
    {
        $user = $this->adminService->createAdmin($request->name, $request->email, $request->password);
        $credentials = $request->only('email', 'password');
        $token = Auth::guard('admin-api')->attempt($credentials);
        if ($token) {
            return $this->respondWithToken($token);
        }
    }
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');
        $guard = $request->is_admin ? 'admin-api' : 'api';
        if (!$token = Auth::guard($guard)->attempt($credentials)) {
            return response()->json(['message' => 'Invalid username or password.'], 401);
        }
       
        return $this->respondWithToken($token);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function user(): JsonResponse
    {
        return response()->json(Auth::user());
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh(): JsonResponse
    {
        return $this->respondWithToken(Auth::refresh());
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(): JsonResponse
    {
        Auth::logout();
        return response()->json(['message' => 'Successfully logged out.']);
    }

    /**
     * @param string $token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken(string $token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
            'user' => Auth::user()
        ]);
    }
}
