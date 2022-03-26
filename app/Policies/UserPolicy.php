<?php

namespace App\Policies;

use App\Models\Student;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny($student)
    {

        $guard = auth('admin')->check() ? 'admin' : 'student';
        return auth($guard)->user()->hasPermissionTo('Add-Data-Company')
            ? $this->allow()
            : $this->deny();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Student  $user
     * @param  \App\Models\Student  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($user, Student $model)
    {
        //
        $guard = auth('admin')->check() ? 'admin' : 'web';
        return auth($guard)->user()->hasPermissionTo('Read-Users')
            ? $this->allow()
            : $this->deny();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Student  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create($user)
    {
        //
        $guard = auth('admin')->check() ? 'admin' : 'web';
        return auth($guard)->user()->hasPermissionTo('Create-Student')
            ? $this->allow()
            : $this->deny();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Student  $user
     * @param  \App\Models\Student  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($user, Student $model)
    {
        //
        $guard = auth('admin')->check() ? 'admin' : 'web';
        return auth($guard)->user()->hasPermissionTo('Update-Student')
            ? $this->allow()
            : $this->deny();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Student  $user
     * @param  \App\Models\Student  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($user, Student $model)
    {
        //
        $guard = auth('admin')->check() ? 'admin' : 'web';
        return auth($guard)->user()->hasPermissionTo('Delete-Student')
            ? $this->allow()
            : $this->deny();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Student  $user
     * @param  \App\Models\Student  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Student $user, Student $model)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Student  $user
     * @param  \App\Models\Student  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Student $user, Student $model)
    {
        //
    }
}
