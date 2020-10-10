@extends('layout')

@section('content')

    @forelse( $posts as $post)

  <div class="row">
 
    <a href="{{ route('posts.show', [ 'post' => $post->id ])}}" class="btn btn-link">{{ $post->title }}</a>
    <p>added by {{ $post->user->name}}</p>
    <p>added at {{$post->created_at->diffForHumans( )}}</p>
    @if($post->comments_count)
        <p>{{$post->comments_count}} comments</p>
    @else
        <p>No comment yet</p>
    @endif

    @can('update', $post)   
        <a class="btn btn-link" href="{{ route('posts.edit', ['post' => $post->id])}}">Edit</a>
    @endcan

    @can('delete', $post)
    <form action="{{ route('posts.destroy', ['post' => $post->id])}}" method = "POST">

        @csrf
        @method('DELETE')

        <input type="submit" value="Delete" class="btn btn-link"/>
    </form>
    @endcan
 </div>




    @empty

        <p>No blog post yet</p>

    @endforelse

    

@endsection