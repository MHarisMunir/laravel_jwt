@extends('layouts.home')

@section('content')
<div>
    <h1>{{ auth()->user()->name }}</h1>

</div>
<div>
    <ul>
        <li>Dashboard</li>
        <li>All Users</li>
        <a href="/show">Show All Users</a>



        </a>
    </ul>
</div>

@endsection

