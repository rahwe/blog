<?php

// namespace App\Scopes;

// use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Scope;

// class LatestScope implements Scope
// {
//     public function apply(Builder $builder, Model $model)
//     {   //when we make scope and apply it to any model
//         //laravel will add query that we create by our 
//         // ownself to the original query in that model
//         // below we make the post orderBy(create_at,'desc' )
//         $builder->orderBy($model::CREATED_AT, 'desc');
//     }
// }

