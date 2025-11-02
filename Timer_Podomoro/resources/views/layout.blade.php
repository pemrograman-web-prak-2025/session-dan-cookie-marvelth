<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>@yield('title','Podomoro Timer')</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; background: linear-gradient(120deg,#fdfbfb 0%,#ebedee 100%); }
    .glass { background: rgba(255,255,255,0.6); backdrop-filter: blur(6px); box-shadow: 0 8px 30px rgba(0,0,0,0.08); }
    .accent { background: linear-gradient(90deg,#ff7a18,#af002d 60%); -webkit-background-clip: text; color: transparent; }
  </style>
  @stack('head')
</head>
<body class="min-h-screen flex flex-col items-center py-10">
  <header class="w-full max-w-4xl px-6 mb-6">
    <nav class="flex items-center justify-between">
      <a href="{{ route('timers.index') }}" class="text-2xl font-extrabold accent">PODOMORO TIMER</a>
      <div class="space-x-4">
        @auth
          <span class="text-sm text-gray-700 mr-2">Hi, {{ auth()->user()->name }}</span>
          <a href="{{ route('timers.index') }}" class="py-2 px-3 rounded-md glass hover:scale-105 transition">Dashboard</a>
          <a href="{{ route('timers.history') }}" class="py-2 px-3 rounded-md glass hover:scale-105 transition">History</a>
          <form action="{{ route('logout.perform') }}" method="POST" class="inline">@csrf<button class="py-2 px-3 rounded-md bg-red-500 text-white hover:opacity-90">Logout</button></form>
        @endauth
        @guest
          <a href="{{ route('login.show') }}" class="py-2 px-3 rounded-md glass hover:scale-105 transition">Login</a>
          <a href="{{ route('register.show') }}" class="py-2 px-3 rounded-md glass hover:scale-105 transition">Register</a>
        @endguest
      </div>
    </nav>
  </header>

  <main class="w-full max-w-4xl px-6">
    <div class="glass rounded-2xl p-6">
      @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-4">
          <p class="text-green-700">{{ session('success') }}</p>
        </div>
      @endif
      @yield('content')
    </div>
  </main>

  <footer class="w-full max-w-4xl px-6 mt-8 text-center text-sm text-gray-500">
    Podomoro Timer
  </footer>

  @stack('scripts')
</body>
</html>
