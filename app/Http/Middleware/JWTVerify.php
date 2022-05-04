<?php

namespace App\Http\Middleware;

use App\Helpers\PublicHelper;
use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use DateTimeImmutable;
use Exception;
use Firebase\JWT\ExpiredException;
use Illuminate\Http\Request;

class JWTVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $publicHelper = new PublicHelper();

        try {
            $token = $publicHelper->GetAndDecodeJWT();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }

        return $next($request);
    }
}
