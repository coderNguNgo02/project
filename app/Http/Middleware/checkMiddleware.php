<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class checkMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (Auth::user()->level == 1) {
                return redirect('/admin/index'); // Đường dẫn đến trang sau khi đăng nhập thành công
            }
            if (Auth::user()->level == 2) {
                return redirect('/user/index'); // Đường dẫn đến trang sau khi đăng nhập thành công
            }
        }
        return $next($request);
    }
}
