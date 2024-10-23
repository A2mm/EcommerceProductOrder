<?php

namespace App\Http\Controllers\Auth;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\Auth\AuthService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class AuthController extends Controller
{
    /**
     * @param AuthService $authService
    **/

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request): JsonResponse
    {
        try{
            $response = $this->authService->login($request->only('email', 'password'));
            if(!$response['status'] ?? null){
                return $this->errorResponse($response, $response['status_code'], $response['message']);
            }
            return $this->successResponse($response, $response['status_code'], $response['message']);
        }catch(Exception $exception){
            throw new Exception($exception->getMessage(),$exception->getCode());
        }
    }
}
