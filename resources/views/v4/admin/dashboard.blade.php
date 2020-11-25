@extends('v4.layouts.app')

@section('head')
<title>{{ $user->name }}'s Dashboard</title>
@endsection

@section('content')

@if($user->roles->where('slug','admin')->first())
<h2>Key Management</h2>
@else
<p>You are not an admin</p>
@endif


@endsection