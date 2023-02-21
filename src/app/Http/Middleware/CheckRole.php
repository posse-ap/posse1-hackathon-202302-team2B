<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Role;

class CheckRole
{
    public function handle($request, Closure $next, string $role)
    {
        $user = $request->user();
        if (!$user->hasRole($role)) {
            $role_id = $user->role_id;

            if ($role_id === Role::getAdminId() || $role_id === Role::getDeliveryAgentId()) {
                return redirect()
                        ->route('delivery-list')
                        ->with([
                            'flush.message' => 'ページ閲覧権限がありません',
                            'flush.alert_type' => 'danger',
                        ]);
            } else {
                return redirect()
                        ->route('home')
                        ->with([
                            'flush.message' => 'ページ閲覧権限がありません',
                            'flush.alert_type' => 'danger',
                        ]);;
            }
        }

        return $next($request);
    }
}