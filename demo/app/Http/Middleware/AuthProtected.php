<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class AuthProtected extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try{
            $user = JWTAuth::parseToken()->authenticate();
        }catch(\Exception $e){
            if ($e instanceof TokenInvalidException) {
                return response()->json([
                    'error' => 'Token inválido.',
                ], JsonResponse::HTTP_UNAUTHORIZED);
            }

            if ($e instanceof TokenExpiredException) {
                return response()->json([
                    'error' => 'Token expirado.',
                ], JsonResponse::HTTP_UNAUTHORIZED);
            }

            return response()->json([
                'error' => 'Acesso negado token inválido ou não encontrado.',
            ], JsonResponse::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
