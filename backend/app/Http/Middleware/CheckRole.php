<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        if ($request->user()->role->name !== $role) {
            return response()->json(['message' => 'Không có quyền truy cập vùng này!!!'], 403);
        }

        return $next($request);
    }
}
