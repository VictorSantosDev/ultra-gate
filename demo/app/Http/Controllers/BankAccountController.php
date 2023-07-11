<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\DepositRequest;
use App\Domain\BankDeposit\Service\BanckDepositService;

class BankAccountController extends Controller
{
    private BanckDepositService $banckDepositService;
    
    public function __construct()
    {
        $this->banckDepositService = new BanckDepositService;
    }

    public function depositAction(DepositRequest $request)
    {
        try{
            $output = $this->banckDepositService->deposit($request->validated());

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
