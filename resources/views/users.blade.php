@extends('layouts.app')
@section('title','User Accounts')
@section('content')
<h1>User Accounts</h1><p><a href="{{ route('users.create') }}">+ Create User</a></p>
@if(session('success'))<p style="color:green">{{ session('success') }}</p>@endif
<table border="1" cellpadding="10"><tr><th>ID</th><th>Avatar</th><th>Username</th><th>Full Name</th><th>Action</th></tr>
@forelse($users as $user)<tr><td>{{ $user->id }}</td><td><img src="{{ $user->avatar ? \Illuminate\Support\Facades\Storage::disk('public')->url($user->avatar) : asset('images/avatar-placeholder.svg') }}" width="64" height="64" alt="Avatar for {{ $user->username }}" style="object-fit:cover;border-radius:50%"></td><td>{{ $user->username }}</td><td>{{ $user->full_name }}</td><td><a href="{{ route('users.edit',$user) }}">Edit</a></td></tr>
@empty<tr><td colspan="5">No users found.</td></tr>@endforelse</table>
@endsection
