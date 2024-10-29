<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    // 登録処理を実行
    public function store(RegisterUserRequest $request)
    {
        $validated = $request->validated();

        // ユーザーを作成
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // ログイン画面にリダイレクト
        return redirect()->route('login');
    }
}
