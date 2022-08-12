<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function login()
    {
        session(['user_id' => null]);
        return view('loginRegister');
    }

    public function logout()
    {
        session(['user_id' => null]);
        return redirect()->route('login');
    }

    public function loginPost(LoginRequest $request)
    {
        $user = $this->userRepo->findByName($request->name);

        if (!$user) {
            $user = $this->userRepo->create($request->name);
        }

        session(['user_id' => $user['id']]);

        return redirect()->route('questions');
    }
}
