@extends('layouts.app')
@section('title',$user->exists?'Edit User':'Create User')
@section('content')
<h1>{{ $user->exists?'Edit User':'Create User' }}</h1>
<form method="POST" enctype="multipart/form-data" action="{{ $user->exists ? route('users.update',$user) : route('users.store') }}">
@csrf @if($user->exists) @method('PUT') @endif
<p><label>Username <input name="username" required value="{{ old('username',$user->username) }}"></label> @error('username')<span style="color:red">{{ $message }}</span>@enderror</p>
<p><label>Full Name <input name="full_name" required value="{{ old('full_name',$user->full_name) }}"></label> @error('full_name')<span style="color:red">{{ $message }}</span>@enderror</p>
@if($user->exists)
<p>Current avatar: <img width="80" height="80" style="object-fit:cover" alt="Current avatar" src="{{ $user->avatar ? \Illuminate\Support\Facades\Storage::disk('public')->url($user->avatar) : asset('images/avatar-placeholder.svg') }}"></p>
<p><label>New avatar (optional, JPG/PNG/WebP, max 2 MB): <input type="file" name="avatar" accept="image/jpeg,image/png,image/webp"></label> @error('avatar')<span style="color:red">{{ $message }}</span>@enderror</p>
@endif
<button type="submit">Save User</button> <a href="{{ route('users') }}">Cancel</a>
</form>
@endsection
