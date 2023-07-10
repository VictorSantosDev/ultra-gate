<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAddressRequest;
use App\Domain\Address\Service\AddressService;

class AddressController extends Controller
{
    private AddressService $addressService;

    public function __construct()
    {
        $this->addressService = resolve(AddressService::class);
    }

    public function createAction(CreateAddressRequest $request)
    {
        try{
            $output = $this->addressService->create($request->validated());

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
