<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $roles): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();
        Log::info('Raw roles parameter: "' . $roles . '"');
        $allowedRoles = array_map('trim', explode('|', $roles));

        // 🔍 DEBUG
        Log::info('=== MIDDLEWARE DEBUG ===');
        Log::info('URL: ' . $request->url());
        Log::info('Usuario: ' . $user->email);
        Log::info('Rol del usuario: "' . $user->role . '"');
        Log::info('Roles permitidos: ' . json_encode($allowedRoles));
        Log::info('¿Permitido?: ' . (in_array($user->role, $allowedRoles) ? 'SÍ' : 'NO'));
        Log::info('=======================');

        if (!in_array($user->role, $allowedRoles)) {
            abort(403, 'Acceso denegado. No tienes permisos para esta acción.');
        }

        return $next($request);
    }
}