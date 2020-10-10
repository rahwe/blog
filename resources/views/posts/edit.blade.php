@extends('layout')

@section('content')

    <form action="{{ route('posts.update', ['post' => $post->id])}}" method = "POST">

        @csrf
        @method('PUT')

        @include('posts._form')
        <button type="submit" class="btn btn-primary">Update</button>
    </form>

@endsection