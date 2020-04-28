<?php

namespace App\Http\Controllers\Auth;

use App\Codes\AppCodes;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Controller as BaseController;
use App\Http\Requests\User\PasswordLoginRequest;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends BaseController
{
    /**
     * The guard name.
     *
     * @var string
     */
    protected $guardName = 'weibo';
    /**
     * The JWTGuard instance.
     *
     * @var \Tymon\JWTAuth\JWTGuard
     */
    protected $jwtGuard;

    /**
     * Controller methods of the throttle middleware should exclude.
     *
     * @var array
     */
    protected $throttleExcepts = [];

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->jwtGuard = auth($this->guardName);
        $this->middleware('auth:weibo', ['except' => ['passwordLogin', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function passwordLogin(PasswordLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = $this->jwtGuard->attempt($credentials)) {
            return http_error('登录失败', 500, ['error' => AppCodes::MESSAGES[AppCodes::AUTH_FAILED]]);
        }

        return $this->responseWithToken($token);
    }
    protected function responseWithToken(string $token): JsonResponse
    {
        /** @var \Tymon\JWTAuth\Factory $factory */
        /** @noinspection PhpUndefinedMethodInspection */
        $factory = $this->jwtGuard->factory();

        return http_success('登录成功', [
            'token' => $token,
            'tokenType' => 'bearer',
            'expiresIn' => $factory->getTTL() * 60,
        ]);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        $user = User::findOrFail($id);
        return new UserResource($user);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ]);
    }
    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function register(UserStoreRequest $request)
    {
        if (User::columnValueExists('name', $request->name, null, User::withTrashed())) {
            return http_error('注册失败', 500, ['error' => AppCodes::MESSAGES[AppCodes::USER_NAME_ALREADY_EXISTS]]);
        }

        if (User::columnValueExists('email', $request->email, null, User::withTrashed())) {
            return http_error('注册失败', 500, ['error' => AppCodes::MESSAGES[AppCodes::USER_EMAIL_ALREADY_EXISTS]]);
        }
        return DB::transaction(function () use ($request) {
            $user = new User([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $user->save();
            return http_success('注册成功', $user);
        });

    }
}
