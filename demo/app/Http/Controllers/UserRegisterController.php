<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use App\Domain\UserRegister\Service\UserRegisterService;

class UserRegisterController extends Controller
{
    private UserRegisterService $userRegisterService;

    public function __construct()
    {
        $this->userRegisterService = resolve(UserRegisterService::class);
    }

    public function registerAction(UserRegisterRequest $request)
    {
        try{
            $output = $this->userRegisterService->register($request->validated());

            return response()->json([
                'success' => $output,
            ], JsonResponse::HTTP_OK);
        }catch(Exception $e){
            return response()->json([
                'error' => $e->getMessage(),
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
