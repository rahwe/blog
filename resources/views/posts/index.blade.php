@extends('layout')

@section('content')

<div class="row">
  <div class="col-8">


    @forelse( $posts as $post)
        
            <h5>
            @if($post->trashed())
              <del>
            @endif
              <a href="{{ route('posts.show', [ 'post' => $post->id ])}}">{{ $post->title }}</a>
            @if($post->trashed())
              </del>
            @endif
          </h5>
            <div class="col-8 no-gutters">
                <div class="fm-inline">
                  @datetime(['date'=>$post->created_at, 'name'=>$post->user->name])
                    Added
                  @enddatetime
                </div>
                @if($post->comments_count)
                    <p>{{$post->comments_count}} comments</p>
                @else
                    <p>No comment yet</p>
                @endif
            </div>
        
            
        @can('update', $post)   
            <a class="btn btn-link" href="{{ route('posts.edit', ['post' => $post->id])}}">Edit</a>
        @endcan
        
        @if(!$post->trashed())
      
          @can('delete', $post)
          <form action="{{ route('posts.destroy', ['post' => $post->id])}}" method = "POST">

              @csrf
              @method('DELETE')

              <input type="submit" value="Delete" class="btn btn-link"/>
          </form>
          @endcan

        @endif

        @empty

            <p>No blog post yet</p>

        @endforelse
            
       

    


  </div>
  <div class="col-4">
      
    <div class="card" style="width: 18rem;">
        
        <div class="card-body">
          <h5 class="card-title">Most Comment posts</h5>
          <p class="card-text">Below are the posts people talk about the most.</p>
        </div>

        
        <ul class="list-group list-group-flush">

          @foreach($mostCommentPost as $post)
        <a href="{{ route('posts.show',['post' => $post->id])}}">
            <li class="list-group-item">{{$post->title}}</li>
          </a>
          @endforeach

        </ul>
        <div class="card-body">
          <h5 class="card-title">Most Active Users</h5>
          <p class="card-text">People who post more.</p>
        </div>
        <div class="card-body">
          @foreach($mostActiveUser as $activeUser)
        <a href="#" class="card-link">{{ $activeUser->name }}</a>
          @endforeach
          
        </div>

      </ul>
      <div class="card-body">
        <h5 class="card-title">Most Active Users last month</h5>
        <p class="card-text">People who post more last month.</p>
      </div>
      <div class="card-body">
        @foreach($mostActiveUserLastMonth as $activeUserLastMonth)
      <a href="#" class="card-link">{{ $activeUserLastMonth->name }}</a>
        @endforeach
        
      </div>

        
      </div>
  </div>
</div>
    

@endsection