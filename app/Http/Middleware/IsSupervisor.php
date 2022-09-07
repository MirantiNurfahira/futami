<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class IsSupervisor
{
	
	public function handle($request, Closure $next)
	{
		if (auth::guard('users')->user()->role !== "supervisor") {
			

			return redirect('/login');
		}

		return $next($request);
	}
}

?>