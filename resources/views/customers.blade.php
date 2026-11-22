@extends('layouts.app')
@section('title','Customer Accounts')
@section('content')
<h1>Customer Accounts</h1><p><a href="{{ route('customers.create') }}">+ Create Customer</a></p>
@if(session('success'))<p style="color:green">{{ session('success') }}</p>@endif
<table border="1" cellpadding="10"><tr><th>ID</th><th>Full Name</th><th>Email</th><th>Phone</th><th>Action</th></tr>
@forelse($customers as $customer)<tr><td>{{ $customer->id }}</td><td>{{ $customer->full_name }}</td><td>{{ $customer->email }}</td><td>{{ $customer->phone }}</td><td><a href="{{ route('customers.edit',$customer) }}">Edit</a></td></tr>
@empty<tr><td colspan="5">No customers found.</td></tr>@endforelse</table>
@endsection
