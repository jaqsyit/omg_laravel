<?php

namespace App\Http\Controllers\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\AuthRequest;
use App\Services\v1\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{

    /**
     * @param AuthRequest $request
     * @param AuthService $service
     * @return JsonResponse
     */

    protected $AuthService;

    public function __construct(AuthService $AuthService)
    {
        $this->AuthService = $AuthService;
    }

    public function actionLoginUser(Request $request)
    {
        return $this->AuthService->login($request->all());
    }

    public function actionLogoutUser()
    {
        return $this->AuthService->logout();
    }

    public function actionRefreshToken()
    {
        return $this->AuthService->refreshToken();
    }
    public function actionCheckUser()
    {
        $user = Auth::user();
        $user['remember_token'] =  JWTAuth::fromUser($user);

        return $user;
    }

    public function actionChangePassword(Request $request)
    {
        return $this->AuthService->changePassword($request);
    }
}
