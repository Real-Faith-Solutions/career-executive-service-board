@extends('layouts.guest')

@section('content')
    <h1 class="text-red-500">{{ $response['message'] }}</h1>
    <a class="btn btn-primary my-5" href="{{ $response['link'] }}" role="button">Try again</a>
@endsection
