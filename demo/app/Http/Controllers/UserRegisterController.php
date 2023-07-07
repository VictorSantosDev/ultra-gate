<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;

class UserRegisterController extends Controller
{
    public function registerAction(UserRegisterRequest $request)
    {
        dd($request);
    }
}
