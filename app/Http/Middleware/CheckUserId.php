<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserId
{
    public function handle(Request $request, Closure $next, ...$allowedFunctions)
    {
        if (!in_array(auth()->user()->function_id, $allowedFunctions)) {
            return redirect()->route('dashboard')->with('error', 'Je hebt geen toegang tot deze pagina.');
        }

        return $next($request);
    }
}
