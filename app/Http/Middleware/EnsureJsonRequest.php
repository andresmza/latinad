<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponse;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EnsureJsonRequest
{
    Use ApiResponse;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->isJson() || $request->header('Content-Type') !== 'application/json') {
            return $this->jsonResponse(Response::HTTP_NOT_ACCEPTABLE, false, 'Invalid request headers. Content-Type must be application/json.', 'Invalid headers');
        }

        return $next($request);
    }
}
