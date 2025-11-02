<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timer;
use Illuminate\Support\Facades\Auth;

class TimerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $timers = Auth::user()->timers()->latest()->get();
        return view('timers.index', compact('timers'));
    }

    public function create()
    {
        return view('timers.create');
    }

    public function store(Request $req)
    {
        $req->validate([
            'title' => 'required|string|max:255',
            'minutes' => 'required|integer|min:1|max:600',
        ]);

        Auth::user()->timers()->create([
            'title' => $req->title,
            'minutes' => $req->minutes,
            'completed' => 0,
        ]);

        return redirect()->route('timers.index')->with('success', 'Timer berhasil dibuat!');
    }

    public function edit(Timer $timer)
    {
        return view('timers.edit', compact('timer'));
    }

    public function update(Request $req, Timer $timer)
    {
        $req->validate([
            'title' => 'required|string|max:255',
            'minutes' => 'required|integer|min:1|max:600',
        ]);

        $timer->update($req->only(['title', 'minutes']));
        return redirect()->route('timers.index')->with('success', 'Timer diperbarui!');
    }

    public function destroy(Timer $timer)
    {
        $timer->delete();
        return redirect()->route('timers.index')->with('success', 'Timer dihapus!');
    }

    public function history()
    {
        $history = Auth::user()->timers()->where('completed', 1)->latest()->get();
        return view('timers.history', compact('history'));
    }

    public function markCompleted(Timer $timer)
    {
        $this->authorize('modify', $timer);

        $timer->update([
            'completed' => 1,
            'ended_at' => now(),
        ]);

        return response()->json(['ok' => true]);
    }
}
