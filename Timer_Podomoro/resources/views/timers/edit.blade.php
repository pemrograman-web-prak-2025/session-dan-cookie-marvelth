@extends('layout')

@section('title','Edit Timer')
@section('content')
<h2 class="text-xl font-bold mb-4">Edit Timer</h2>
<form method="POST" action="{{ route('timers.update',$timer) }}" class="space-y-4">
  @csrf @method('PUT')
  <div><input name="title" value="{{ old('title',$timer->title) }}" required class="w-full p-3 rounded-md border" placeholder="Nama Kegiatan"></div>
  <div><input name="minutes" type="number" value="{{ old('minutes',$timer->minutes) }}" required class="w-full p-3 rounded-md border" placeholder="Durasi (menit)"></div>
  <div><button class="px-4 py-2 bg-indigo-600 text-white rounded-md">Update</button></div>
</form>
@endsection
