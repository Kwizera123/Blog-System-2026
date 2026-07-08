@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Dashboard</h1>
        <p>Welcome back, {{ auth()->user()->name }}</p>
    </div>
@endsection