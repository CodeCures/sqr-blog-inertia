<?php

namespace App\Scopes;

use App\Enums\PostState;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class UserAuthenticatedScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        if ($this->isAllowedRoute()) {
            return auth()->user()->isAdmin() ?: $builder->where('user_id', auth()->id());
        }
        
        $builder->where('state', PostState::Published);
    }

    public function isDashboardRoute()
    {
        return request()->routeIs('dashboard');
    }

    public function isEditRoute()
    {
        return request()->routeIs('post.edit');
    }

    public function isUpdateRoute()
    {
        return request()->routeIs('post.update');
    }

    public function isDeleteRoute()
    {
        return request()->routeIs('post.delete');
    }

    public function isAllowedRoute()
    {
        return $this->isDashboardRoute() || 
               $this->isEditRoute() ||
               $this->isUpdateRoute() ||
               $this->isDeleteRoute();
    }
}
