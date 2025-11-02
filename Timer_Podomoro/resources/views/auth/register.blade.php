@extends('layout')

@section('title','Register')
@section('content')
<div class="max-w-xl mx-auto p-4">
  <h2 class="text-3xl font-bold mb-4">Create account</h2>
  <form method="POST" action="{{ route('register.perform') }}" class="space-y-4">
    @csrf
    <div><input name="name" value="{{ old('name') }}" required class="w-full p-3 rounded-md border" placeholder="Full name"></div>
    <div><input name="email" value="{{ old('email') }}" required class="w-full p-3 rounded-md border" placeholder="Email"></div>
    <div><input name="password" type="password" required class="w-full p-3 rounded-md border" placeholder="Password"></div>
    <div><input name="password_confirmation" type="password" required class="w-full p-3 rounded-md border" placeholder="Confirm Password"></div>
    <div><button class="px-4 py-2 bg-emerald-500 text-white rounded-md">Register</button></div>
  </form>
</div>
@endsection
