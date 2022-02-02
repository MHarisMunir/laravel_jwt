@extends('layouts.app')

@section('content')
    <div>
        <h1>{{ auth()->user()->name }}</h1>

    </div>
    <div>
        <ul>
            <li>Dashboard</li>
            <a href="{{route('allusers')}}">
            <li>All Users</li>
            </a>
        </ul>
    </div>
@endsection
