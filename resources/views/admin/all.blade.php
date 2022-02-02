@extends('layouts.app')

@section('content')

@foreach($users as $user)

    <ul>
        <li>{{$user->name}}</li>
    </ul>

@endforeach

@endsection
