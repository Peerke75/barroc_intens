<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Malfunction;

class MalfunctionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $malfunctions = Malfunction::orderBy('date', 'asc')->get();

        return view('malfunctions.malfunction-index', compact('malfunctions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('malfunctions.malfunction-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Malfunction::create($request->all());

        return redirect()->route('malfunctions.malfunction-index')->with('success', 'Storing toegevoegd');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $malfunction = Malfunction::findOrFail($id);

        return view('malfunctions.malfunction-show', compact('malfunction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $malfunction = Malfunction::findOrFail($id);

        return view('malfunctions.malfunction-edit', compact('malfunction'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $malfunction = Malfunction::findOrFail($id);
        $malfunction->update($request->all());

        return redirect()->route('malfunctions.malfunction-index')->with('success', 'Storing bijgewerkt');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $malfunction = Malfunction::findOrFail($id);
        $malfunction->delete();

        return redirect()->route('malfunctions.malfunction-index')->with('success', 'Storing verwijderd');
    }
}
