@extends('layout')

@section('content')

<h5>Contact Page<h5>

@can('contact.secret')
    <a href="{{ route('secret')}}">Go to secret contact page</a>
@endcan

@endsection