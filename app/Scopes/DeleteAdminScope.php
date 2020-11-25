<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class DeleteAdminScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {   //when we make scope and apply it to any model
        // we can make more complex query
        // deleteAdminScope is called by BlogPost
        // to make user with is_admin can see
        // deleted posts
        if(Auth::check() && Auth::user()->is_admin)
        {
            $builder->withTrashed();
        }
    }
}