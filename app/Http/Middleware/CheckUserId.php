<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserId
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $userId = Auth::id();

        $allowedUserIds = range(0, 8);  

        if (!in_array($userId, $allowedUserIds)) {
            return redirect()->route('home')->with('error', 'Je hebt geen toegang tot deze pagina.');
        }

        return $next($request);
    }
}
