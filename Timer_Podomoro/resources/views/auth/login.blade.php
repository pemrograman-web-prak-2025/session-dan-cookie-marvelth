@extends('layout')

@section('title','Login')
@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
  {{-- Kolom kiri (Form Login) --}}
  <div class="p-6">
    <h2 class="text-3xl font-bold mb-2">Welcome back</h2>
    <p class="text-gray-600 mb-6">Masuk untuk mengelola jadwal kegiatanmu.</p>
    <form method="POST" action="{{ route('login.perform') }}" class="space-y-4">
      @csrf
      <div>
        <input name="email" value="{{ old('email') }}" required class="w-full p-3 rounded-md border" placeholder="Email">
      </div>
      <div>
        <input name="password" type="password" required class="w-full p-3 rounded-md border" placeholder="Password">
      </div>
      <div class="flex items-center justify-between">
        <label class="text-sm">
          <input type="checkbox" name="remember"> Remember me
        </label>
        <button class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">Login</button>
      </div>
    </form>
  </div>
  <div class="p-6 hidden md:flex items-center justify-center">
    <div class="relative h-64 w-full rounded-xl overflow-hidden shadow-lg flex items-center justify-center">
      <img src="{{ asset('meme.jpeg') }}" 
           alt="Focus session" 
           class="absolute inset-0 w-full h-full object-cover">
    </div>
  </div>
</div>
@endsection
