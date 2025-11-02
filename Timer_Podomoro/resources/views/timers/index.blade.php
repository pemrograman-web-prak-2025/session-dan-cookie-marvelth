@extends('layout')

@section('title','Timers')
@section('content')
<div class="flex items-center justify-between mb-6">
  <h1 class="text-2xl font-bold">My Timers</h1>
  <a href="{{ route('timers.create') }}" class="px-4 py-2 rounded-md bg-blue-500 text-white">New Timer</a>
</div>

@if($timers->isEmpty())
  <div class="text-center py-12 text-gray-500">Belum ada timer. Buat timer pertamamu!</div>
@else
  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    @foreach($timers as $timer)
      <div class="p-4 rounded-xl glass relative">
        <div class="flex justify-between items-start">
          <div>
            <h3 class="font-semibold text-lg">{{ $timer->title }}</h3>
            <p class="text-sm text-gray-500">{{ Str::limit($timer->description,80) }}</p>
          </div>
          <div class="text-right">
            <div class="text-sm text-gray-400">Durasi</div>
            <div class="text-xl font-bold">{{ $timer->minutes }} min</div>
          </div>
        </div>

        <div class="mt-4 flex items-center space-x-2">
          <button class="start-btn px-3 py-2 rounded-md bg-green-500 text-white" data-id="{{ $timer->id }}" data-minutes="{{ $timer->minutes }}">Start</button>
          <a href="{{ route('timers.edit',$timer) }}" class="px-3 py-2 rounded-md glass">Edit</a>
          <form action="{{ route('timers.destroy',$timer) }}" method="POST" onsubmit="return confirm('Hapus timer?')" class="inline">@csrf @method('DELETE')<button class="px-3 py-2 rounded-md bg-red-400 text-white">Delete</button></form>
        </div>

        <div class="mt-4">
          <div class="timer-display text-2xl font-mono" id="timer-{{ $timer->id }}">--:--</div>
        </div>
      </div>
    @endforeach
  </div>
@endif

@endsection

@push('scripts')
<script src="{{ asset('pomodoro.js') }}"></script>
@endpush
