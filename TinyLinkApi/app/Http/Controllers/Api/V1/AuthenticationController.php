<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\LoginFormRequest;
use App\Http\Resources\V1\UserApiResource;
use App\Http\Services\V1\AuthenticationService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class AuthenticationController extends Controller
{
    /**
     * User login endpoint
     *
     * @param LoginFormRequest $request
     * @return JsonResponse
     */
    public function login(LoginFormRequest $request)
    {
        try {
            ['user' => $user, 'token' => $token] = AuthenticationService::userLoginToken(credentials: $request->fields());

            return $this->successResponse(data: [
                'token' => $token,
                'user' => new UserApiResource($user),
            ], message: 'Login successful');
        } catch (Throwable $e) {
            logger()->critical($e->getMessage());
            return $this->errorResponse(message: $e->getMessage(), code: Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * User logout endpoint
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        try {
            if (auth()->user() && auth()->user()->currentAccessToken()) {
                auth()->user()->token()->revoke();
            }

            return $this->successResponse(message: 'Logout successful');
        } catch (Throwable $e) {
            logger()->critical($e->getMessage());
            return $this->errorResponse(message: $e->getMessage());
        }
    }
}
