<?php

namespace App\Policies;

use App\Models\FormationSession;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FormationSessionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, FormationSession $formationSession): bool
    {
        return $user->role === 'admin' || $formationSession->trainer_id === $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user->role === 'admin'
            ? Response::allow()
            : Response::deny('Vous ne pouvez pas créer de formation.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, FormationSession $formationSession): Response
    {
        return $user->role === 'admin'
            ? Response::allow()
            : Response::deny('Vous ne pouvez pas modifier cette formation.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, FormationSession $formationSession): Response
    {
        return $user->role === 'admin'
            ? Response::allow()
            : Response::deny('Vous ne pouvez pas supprimer cette formation.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, FormationSession $formationSession): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, FormationSession $formationSession): bool
    {
        return $user->role === 'admin';
    }
}