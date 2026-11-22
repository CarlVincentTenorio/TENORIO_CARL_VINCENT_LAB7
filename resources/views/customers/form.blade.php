@extends('layouts.app')
@section('title',$customer->exists?'Edit Customer':'Create Customer')
@section('content')
<h1>{{ $customer->exists?'Edit Customer':'Create Customer' }}</h1>
<form method="POST" action="{{ $customer->exists ? route('customers.update',$customer) : route('customers.store') }}">@csrf @if($customer->exists) @method('PUT') @endif
<p><label>Full Name <input name="full_name" required value="{{ old('full_name',$customer->full_name) }}"></label> @error('full_name')<span style="color:red">{{ $message }}</span>@enderror</p>
<p><label>Email <input type="email" name="email" required value="{{ old('email',$customer->email) }}"></label> @error('email')<span style="color:red">{{ $message }}</span>@enderror</p>
<p><label>Phone <input name="phone" value="{{ old('phone',$customer->phone) }}"></label> @error('phone')<span style="color:red">{{ $message }}</span>@enderror</p>
<button type="submit">Save Customer</button> <a href="{{ route('customers') }}">Cancel</a>
</form>
@endsection
