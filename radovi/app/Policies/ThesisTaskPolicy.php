<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ThesisTask;

class ThesisTaskPolicy
{
    public function viewAny(User $user)
    {
        return in_array($user->role, ['admin', 'professor']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ThesisTask $thesisTask): bool
    {
        return $user->id === $thesisTask->teacher_id || $user->role === 'admin';
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        return in_array($user->role, ['admin', 'professor']);
    }

    public function update(User $user, ThesisTask $thesisTask)
    {
        return $user->id === $thesisTask->teacher_id || $user->role === 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ThesisTask $thesisTask): bool
    {
        return $user->id === $thesisTask->teacher_id || $user->role === 'admin';
    }
}
