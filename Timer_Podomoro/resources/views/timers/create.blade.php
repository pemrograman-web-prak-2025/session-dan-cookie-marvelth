@extends('layout')

@section('title','Create Timer')
@section('content')
<h2 class="text-xl font-bold mb-4">Buat Timer Baru</h2>
<form method="POST" action="{{ route('timers.store') }}" class="space-y-4">
  @csrf
  <div><input name="title" value="{{ old('title') }}" required class="w-full p-3 rounded-md border" placeholder="Nama Kegiatan"></div>
  <div><input name="minutes" type="number" required class="w-full p-3 rounded-md border" placeholder="Durasi (menit)"></div>
  <div><button class="px-4 py-2 bg-blue-600 text-white rounded-md">Create</button></div>
</form>
@endsection
