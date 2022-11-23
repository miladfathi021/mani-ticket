<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\V1\ApiController;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Laravel\Passport\Bridge\UserRepository;

class LoginController extends ApiController
{
    public function store(LoginRequest $request) : \Illuminate\Http\JsonResponse
    {
        if (!auth()->attempt($request->all())) {
            return $this->setStatus(401)->response([], 'Invalid Credentials provided!');
        }

        $token = auth()->user()->createToken('API Token')->accessToken;

        return $this->response([
            'token' => $token
        ]);
    }
}
