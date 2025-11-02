@extends('layout')

@section('title','History')
@section('content')
<h2 class="text-xl font-bold mb-4">History - Completed Sessions</h2>
@if($history->isEmpty())
  <div class="text-center py-12 text-gray-500">Belum ada sesi selesai.</div>
@else
  <ul class="space-y-3">
    @foreach($history as $h)
      <li class="p-3 rounded-md glass flex justify-between items-center">
        <div>
          <div class="font-semibold">{{ $h->title }}</div>
          <div class="text-sm text-gray-500">{{ $h->minutes }} min • selesai pada {{ $h->ended_at }}</div>
        </div>
      </li>
    @endforeach
  </ul>
@endif
@endsection
