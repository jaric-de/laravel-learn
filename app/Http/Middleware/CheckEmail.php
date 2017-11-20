<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class CheckEmail
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
        $userEmail = User::find(auth()->id())->email;

        if ($userEmail === 'yaroslav@gmail.com') {
            return $next($request);
        } else {
            auth()->logout();
            return redirect('home');
        }
    }
}
