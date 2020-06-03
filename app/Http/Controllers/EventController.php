<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Requests\StoreEvent;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $events = Auth::user()->events()
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->get();
        return view('event.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('event.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreEvent  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreEvent $request)
    {
        $data = $request->only('date', 'description');
        if ($request->has('time') && $request->input('time') != null) {
            $validatedData = $request->validate([
                'time' => 'date_format:H:i'
            ]);
            $data['time'] = $validatedData['time'];
        }
        $event = Auth::user()->events()->create($data);
        return redirect()->route('events.show', $event);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\View\View
     */
    public function show(Event $event)
    {
        return view('event.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\View\View
     */
    public function edit(Event $event)
    {
        return view('event.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        return redirect()->route('events.show', $event);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Event $event
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Event $event)
    {
        if ($event->belongsTo(Auth::user())) {
            $event->delete();
        } else {
            return response('Unauthorized', 401);
        }
        return redirect()->route('events.index');
    }
}
