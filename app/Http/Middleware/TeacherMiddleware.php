<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TeacherMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->routeIs('teacher.login')) {
            return $next($request);
        }

        if (!Auth::check()) {
            return redirect()->route('teacher.login');
        }

        if (Auth::user()->role !== 'teacher') {
            return redirect()->route('teacher.login')->with('error', 'Unauthorized access. Teachers only.');
        }
        return $next($request);
    }
}
