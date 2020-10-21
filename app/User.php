<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany('App\BlogPost');

    }

    //scope user that have a lot of post.

    public function scopeMostActiveUser(Builder $query)
    {
        return $query->withCount('Posts')->orderBy('posts_count', 'desc');
    }
    // most active user last month
    public function scopeMostActiveUserLastMonth(Builder $query)
    {
        return $query->withCount(['Posts' => function(Builder $query){
            $query->whereBetween(static::CREATED_AT, [now()->subMonths(1), now()]);
        }])->has('posts', '>=', 2)
        ->orderBy('posts_count', 'desc');
    }
    
}
