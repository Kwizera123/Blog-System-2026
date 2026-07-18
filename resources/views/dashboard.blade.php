@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Dashboard</h1>
        <p>{{ auth()->user()->name }}</p>
        <h2>I always wish the best!</h2>
    </div>
@endsection