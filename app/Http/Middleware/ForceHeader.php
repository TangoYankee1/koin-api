<?php

namespace App\Http\Middleware;

use Closure;

class ForceHeader
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        $response->headers->set('X-FORCE-HEADER', 'YES');
        return $response;
    }
}
