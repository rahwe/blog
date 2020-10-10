<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        'App\BlogPost' => 'App\Policies\BlogPostPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        // open get for protect update post which on belong 
        // to authenticated user
        // this has been called in PostController

        // give the middleware to contact page
        Gate::define('contact.secret', function($user){
            return $user->is_admin;
        });

        // Gate::define('update-post', function($user, $post){

        //     return $user->id == $post->user_id;

        // });

        // open get for protect delete post which on belong 
        // to authenticated user
        // this has been called in PostController

        // Gate::define('delete-post', function($user, $post){

        //     return $user->id == $post->user_id;

        // });
        
        // use policy to do the same thing as above
        // but this make code clean
        // Gate::define('posts.update', 'App\Policies\BlogPostPolicy@update');
        // Gate::define('posts.delete', 'App\Policies\BlogPostPolicy@delete');

        // Gate::resource() is simpler to Route::resource()
        // use one line but get all the method in BlogPostPolicy
        // etc: posts.create, posts.update, posts.view, posts.delete
        Gate::resource('posts', 'App\Policies\BlogPostPolicy');



        // we use Gate::before() to give the abilities for admin
        // this has been called before every Gate::define() above
        Gate::before(function($user, $ability){
            if($user->is_admin){
                return true;
            }
        });
        // We can give specific ability to admin by using in_array() as below
        // Gate::before(function($user, $ability){
        //     if($user->is_admin && in_array($ability, ['update','delete'])){
        //         return true;
        //     }
        // });
    }
}
