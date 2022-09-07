<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class IsOperator
{
	
	public function handle($request, Closure $next)
	{
		if (auth::guard('users')->user()->role !== "operator") {

			return redirect('/login');
		}

		return $next($request);
	}
}

?>