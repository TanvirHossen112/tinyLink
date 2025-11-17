<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Actions\V1\RegisterAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\RegisterFormRequest;
use App\Http\Resources\V1\UserApiResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class RegistrationController extends Controller
{
    /**
     * User registration store endpoint
     *
     * @param RegisterFormRequest $request
     * @param RegisterAction $registerAction
     * @return JsonResponse
     */
    public function store(RegisterFormRequest $request, RegisterAction $registerAction)
    {
        try {
            $user = $registerAction->execute($request->fields());
            logger()->info("authentication:registration -> user registered {$user->id} {$user->email}");

            return $this->successResponse(
                data: new UserApiResource($user),
                message: 'User Registration successful',
                code: Response::HTTP_CREATED
            );
        } catch (Throwable $exception) {
            logger()->critical('authentication:registration ->' . $exception->getMessage());
            return $this->errorResponse(message: 'Registration failed');
        }
    }
}
