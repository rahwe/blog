<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function blogposts()
    {
        return $this->belongsToMany('App\BlogPost')->withTimestamps();
    }
}
