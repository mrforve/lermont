<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
class EnsureTravelLineAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $admin = $request->user('admin');
        if (!$admin) {
            if ($request->expectsJson()) return response()->json(['message'=>'Необходим вход в админку.'],401);
            return redirect()->guest('/admin/login');
        }
        abort_unless($admin->is_active && $admin->canManageContent(),403);
        return $next($request);
    }
}
