<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserAccess
{
    public function handle(Request $request, Closure $next, string $userType)
    {
        if (auth()->user()->type == $userType) {
            return $next($request);
        }

        abort(403, 'Bu sayfaya erişim izniniz yok.'); // veya view döndürebilirsiniz
    }
}
