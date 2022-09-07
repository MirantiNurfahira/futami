<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class IsStaff
{
	
	public function handle($request, Closure $next)
	{
		if (auth::guard('users')->user()->role !== "staff") {
			

			return redirect('/login');
		}

		return $next($request);
	}
}

?>