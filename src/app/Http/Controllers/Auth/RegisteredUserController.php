<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Actions\Fortify\CreateNewUser;
use App\Http\Requests\RegisterUserRequest;

class RegisteredUserController extends Controller
{
    protected $createNewUser;

    public function __construct(CreateNewUser $createNewUser)
    {
        $this->createNewUser = $createNewUser;
    }

    // 登録処理を実行
    public function store(RegisterUserRequest $request)
    {
        $validated = $request->validated();

        $this->createNewUser->create($validated);

        return redirect()->route('login');
    }
}
