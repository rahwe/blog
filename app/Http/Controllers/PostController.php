<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Auth;
use App\BlogPost;


// here is how laravel map the method between 
// policy and PostController

// //controller => policy
//     'show' => 'view',
//     'create' => 'create',
//     'store' => 'create',
//     'edit' => 'update',
//     'update' => 'update',
//     'destroy' => 'delete'
// 


class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')
            ->only(['create','store','delete','update','edit','destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index', [ 
            //withCount method will add attribut comment_count to BlogPost
            //latest() is the scope method from scopeLatest() 
            //use latest() to add more query to existing query of BlogPost model
            'posts'=> BlogPost::latest()->withCount('comments')->get()
            ]);
    }

   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)

    {
        /** keep session for one more request
         **$request->session()->reflash();
        **/
        return view('posts.show', [
            
            'post' => BlogPost::with('comments')->findOrFail($id)
            
            ]);

            // this one way to order comment by created_at
            // another way is to add latest() scope method to
            // the relation in Comment Model
            // return view('posts.show', [
            
            //     'post' => BlogPost::with(['comments' => function($query){
            //         return $query->latest();
            //     }])->findOrFail($id)
                
            //     ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(StorePostRequest $request)
    {
        $validatedData = $request->validated();
        //because in blog_post table has no user_id field
        //we add user_id
        $validatedData['user_id'] = $request->user()->id;
        $blogPost = BlogPost::create($validatedData);

        $request->session()->flash('alert', 'Post is created succesfully.');
        return redirect()->route('posts.show', [ 'post'=>$blogPost->id]);
        
    }

    public function edit($id)
    {
        $post = BlogPost::findOrFail($id);
        $this->authorize($post);
        return view('posts.edit', ['post' => $post ]);
    }
    
    public function update(StorePostRequest $request, $id)
    {
        // use StorePostRequest because we validate the same field as create
        $post = BlogPost::findOrFail($id);

        // short hand of call Gate
        $this->authorize($post);

        
        // call fron AuthServiceProvider
        // if(Gate::denies('update-post', $post)){
        //     abort(403, 'You can not update this post.');
        // }
        $validatedData = $request->validated();
        // fill function used because in field already has some value
        // so don't use create function as when create new field.
        $post->fill($validatedData);
        // after fill value we need to save() to make change
        $post->save();

        $request->session()->flash('alert', 'Post is updated succesfully.');
        return redirect()->route('posts.show', [ 'post'=>$post->id]);

    }

    public function destroy(Request $request, $id)
    {
        $post = BlogPost::findOrFail($id);

        // short hand of call Gate
        $this->authorize($post);

        // call fron AuthServiceProvider
        // if(Gate::denies('update-post', $post)){
        //     abort(403, 'You can not delete this post.');
        // }
        $post->delete();
        $request->session()->flash('alert', 'Post is deleted successully.');
        return redirect()->route('posts.index');
    }

  
}
