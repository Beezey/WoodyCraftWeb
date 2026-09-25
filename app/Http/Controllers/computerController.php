<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Computer;

class computerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $computers = Computer::all();
        return view('computers.index', compact('computers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('computers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'price'       => 'required|numeric|min:0',
        ]);

        $imageData = base64_encode(file_get_contents($request->file('image')->getRealPath()));
        $imageMime = $request->file('image')->getMimeType();
        $validated['image'] = 'data:' . $imageMime . ';base64,' . $imageData;

        Computer::create($validated);

        return redirect()->route('computers.index')
            ->with('message', 'Computer créé avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Computer $computer)
    {
        return view('computers.show', compact('computer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Computer $computer)
    {
        return view('computers.edit', compact('computer'));
    }   

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Computer $computer)
    {
        $rules = [
            'name'        => 'required|string|max:255',
            'category'    => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
        ];

        if ($request->hasFile('image')) {
            $rules['image'] = 'image|mimes:jpeg,png,jpg,gif,webp|max:2048';
        }

        $validated = $request->validate($rules);

        if ($request->hasFile('image')) {
            $imageData = base64_encode(file_get_contents($request->file('image')->getRealPath()));
            $imageMime = $request->file('image')->getMimeType();
            $validated['image'] = 'data:' . $imageMime . ';base64,' . $imageData;
        }

        $computer->update($validated);

        return redirect()->route('computers.index')
            ->with('message', 'Computer mis à jour avec succès !');
    }

    /**
 * Duplicate the specified resource.
 */
    public function duplicate(Computer $computer)
    {
        $newComputer = $computer->replicate();
        $newComputer->name = $computer->name . ' (copie)';
        $newComputer->save();

        return redirect()->route('computers.index')
            ->with('message', 'Computer dupliqué avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Computer $computer)
    {
        $computer->delete();

        return redirect()->route('computers.index')
            ->with('message', 'Computer supprimé avec succès !');
    }
}
