@extends('layouts.app')

@section('title', 'User Dashboard')

@section('content')
    <div class="container">
        <h1>Welcome to your Dashboard</h1>
        <p>This is your dashboard where you can manage your account and view your activities.</p>
        <p>Is user an admin: {{ $user->is_admin == 1 ? "Yes" : "No" }}</p>
    </div>
@endsection