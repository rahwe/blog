@extends('layout')

@section('content')

    <form action="{{ route('posts.store')}}" method = "POST">

        @csrf
        
        @include('posts._form')

        <button type="submit" class="btn btn-primary">Add</button>
    
    </form>
@endsection