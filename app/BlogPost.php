<?php

namespace App;

use App\Scopes\DeleteAdminScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    use softDeletes;
    // customize table name
    //protected $table = 'blogposts';
    protected $fillable = ['title', 'content','user_id'];

    public function comments()
    {
        return $this->hasMany('App\Comment')->latest();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * This below is query scope query builder.
     * we make it to make our own query and apply 
     * it to existing query of the model
     * Scope is used for make more Complicated query
     * for model
     * below code is to make post orderBy created_at ,desc
     */
    public function scopeLatest(Builder $query)
    {
        return $query->orderBy(static::CREATED_AT,'desc');
    }

    public function scopeMostCommentPost(Builder $query){
        return $query->withCount('comments')->orderBy('comments_count', 'desc');
    }
    /***
     * use deleting event to delete the relation 
     * between post and comment
     * when delete post, comment of the post has been
     * delete too.
     * we can use another method called cascading
     */
    public static function boot()
    {
        static::addGlobalScope(new deleteAdminScope);
        parent::boot();

        //static::addGlobalScope(new LatestScope);

        static::deleting(function (BlogPost $blogpost){
            $blogpost->comments()->delete();
        });

        /**
         * restore comments when restore the post
         */
        static::restoring(function(BlogPost $blogPost){
            $blogPost->comments()->restore();
        });

    } 
}
