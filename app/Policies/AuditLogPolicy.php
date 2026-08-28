<?php

namespace App\Policies;

use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AuditLogPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view_any_audit_logs');
    }

    public function view(User $user, AuditLog $auditLog): bool
    {
        return $user->hasPermissionTo('view_audit_logs');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create_audit_logs');
    }

    public function update(User $user, AuditLog $auditLog): bool
    {
        return $user->hasPermissionTo('update_audit_logs');
    }

    public function delete(User $user, AuditLog $auditLog): bool
    {
        return $user->hasPermissionTo('delete_audit_logs');
    }
}
