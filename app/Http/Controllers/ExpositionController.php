<?php

namespace App\Http\Controllers;

use App\Models\Exposition;
use Illuminate\Http\Request;

class ExpositionController extends Controller
{
    public function index()
    {
        $expositions = Exposition::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('admin.expositions.index', compact('expositions'));
    }

    public function create()
    {
        return view('admin.expositions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|max:255',
            'description' => 'nullable|string',
            'lieu' => 'required|max:255',
            'date_debut' => 'required|date|after_or_equal:today',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->date_debut < now()->toDateString()) {
            return back()->withErrors([
                'date_debut' => 'Impossible de créer une exposition dans le passé.'
            ]);
        }

        $imagePath = $request->file('image')
            ? $request->file('image')->store('expositions', 'public')
            : null;

        Exposition::create([
            'titre' => $request->titre,
            'description' => $request->description,
            'lieu' => $request->lieu,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'image' => $imagePath,
            'is_published' => true,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('admin.expositions')
            ->with('success', 'Exposition créée avec succès');
    }

    public function publicIndex()
    {
        $today = now();

        $enCours = Exposition::whereDate('date_debut', '<=', $today)
            ->whereDate('date_fin', '>=', $today)
            ->get();

        $aVenir = Exposition::whereDate('date_debut', '>', $today)
            ->get();

        return view('expositions.index', compact('enCours', 'aVenir'));
    }

    public function pastExpositions()
    {
        $passees = Exposition::whereDate('date_fin', '<', now())
            ->latest()
            ->get();

        return view('expositions.past', compact('passees'));
    }

    public function show(Exposition $exposition)
    {
        return view('expositions.show', compact('exposition'));
    }

    public function edit(Exposition $exposition)
    {
        if ($exposition->user_id !== auth()->id()) {
            abort(403);
        }

        return view('admin.expositions.edit', compact('exposition'));
    }

    public function update(Request $request, Exposition $exposition)
    {
        if ($exposition->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'titre' => 'required|max:255',
            'description' => 'nullable',
            'lieu' => 'required|max:255',
            'date_debut' => 'required|date|after_or_equal:today',
            'date_fin' => 'required|date|after_or_equal:date_debut',
        ]);

        $exposition->update($request->all());

        return redirect()->route('admin.expositions')
            ->with('success', 'Exposition mise à jour');
    }

    public function destroy(Exposition $exposition)
    {
        if ($exposition->user_id !== auth()->id()) {
            abort(403);
        }

        $exposition->delete();

        return back()->with('success', 'Exposition supprimée');
    }
}
