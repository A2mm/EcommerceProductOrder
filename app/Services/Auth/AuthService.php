<?php

namespace App\Services\Auth;

use Symfony\Component\HttpFoundation\Response as HttpResponse;

class AuthService
{
    public function login(array $credentials): array
    {
        if (!auth()->attempt($credentials)) {
            return [
                'message'     => 'Invalid credentials',
                'user'        => null,
                'token'       => null,
                'status_code' => HttpResponse::HTTP_UNAUTHORIZED,
                'status'      => false,
            ];
        }

        $user = auth()->user();
        $token = $user->createToken('token_name')->plainTextToken;

        return [
            'message'     => 'Successful login',
            'user'        => $user,
            'token'       => $token,
            'status_code' => HttpResponse::HTTP_OK,
            'status'      => true,
        ];

    }
}
