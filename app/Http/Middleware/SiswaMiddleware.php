<?php

namespace App\Http\Middleware;

use App\Siswa;
use Closure;
use App\Votes;
use Illuminate\Support\Facades\Auth;

class SiswaMiddleware
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
        $cek = Siswa::with('votes')->first();
        if ($cek->votes = 0) {
            return redirect()->route('siswa');
        }

        return $next($request);
    }
}
