<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CorsDomainRestrictionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $allowedDomains = [
            'https://quran.firanda.com',
            'http://localhost:3000'
        ];

        $origin = $request->header('Origin');

        if (in_array($origin, $allowedDomains)) {
            return $next($request)
                ->header('Access-Control-Allow-Origin', $origin)
                ->header('Access-Control-Allow-Methods', 'GET')
                ->header('Access-Control-Allow-Headers', 'Origin, Content-Type, Authorization');
        }

        return response([
            'message' => 'You are not allowed to access this resource.',
            'origin' => $origin
        ], 401);
    }
}
