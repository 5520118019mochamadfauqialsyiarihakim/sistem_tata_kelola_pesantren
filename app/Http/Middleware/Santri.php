<?php

namespace App\Http\Middleware;

use Closure;

class Santri
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user()->role != 'Santri') {
            return redirect('home');
        }
        return $next($request);
    }
}
