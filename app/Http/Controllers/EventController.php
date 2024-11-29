<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return response()->json($events);
    }

    public function store(Request $request)
    {
        // Valideer input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'nullable|date|after_or_equal:start',
            'description' => 'nullable|string',
        ]);

        // Event opslaan in database
        $event = Event::create(array_merge($validated, ['user_id' => auth()->id()]));

        // Terugsturen van aangemaakte event
        return response()->json($event, 201);
    }


    public function update(Request $request, $id)
    {
        $event = Event::where('id',$id)->where('user_id',auth()->id())->firstOrFail();
        $event->update($request->all());
        return response()->json($event);
    }

    public function destroy($id)
    {
        $event = Event::where('id',$id)->where('user_id',auth()->id())->firstOrFail();
        $event->delete();
        return response()->json(['message' => 'Event deleted']);
    }
}
