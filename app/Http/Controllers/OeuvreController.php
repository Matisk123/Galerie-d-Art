<?php

namespace App\Http\Controllers;

use App\Models\Oeuvre;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OeuvreController extends Controller
{
    public function index()
    {
        $oeuvres = Oeuvre::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('admin.oeuvres.index', compact('oeuvres'));
    }

    public function create()
    {
        return view('admin.oeuvres.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'artist_name' => 'required|string|max:255',
            'categorie' => 'required|string',
            'style' => 'nullable|string',
            'prix' => 'required|numeric',
            'largeur' => 'nullable|numeric',
            'hauteur' => 'nullable|numeric',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
        ]);

        $imagePath = $request->file('image')
            ? $request->file('image')->store('oeuvres', 'public')
            : null;

        Oeuvre::create([
            'user_id' => Auth::id(),
            'titre' => $request->titre,
            'artist_name' => $request->artist_name,
            'categorie' => strtolower(trim($request->categorie)),
            'style' => $request->style ? strtolower(trim($request->style)) : null,
            'prix' => $request->prix,
            'largeur' => $request->largeur,
            'hauteur' => $request->hauteur,
            'description' => $request->description,
            'image' => $imagePath,
            'is_published' => true,
        ]);

        return redirect()->route('admin.oeuvres')
            ->with('success', 'Œuvre ajoutée avec succès');
    }

    public function edit(Oeuvre $oeuvre)
    {
        return view('admin.oeuvres.edit', compact('oeuvre'));
    }

    public function update(Request $request, Oeuvre $oeuvre)
    {
        $request->validate([
            'titre' => 'required|string',
            'artist_name' => 'required|string',
            'categorie' => 'required|string',
            'style' => 'nullable|string',
            'prix' => 'required|numeric',
            'largeur' => 'nullable|numeric',
            'hauteur' => 'nullable|numeric',
            'description' => 'nullable|string',
        ]);

        $oeuvre->update([
            'titre' => $request->titre,
            'artist_name' => $request->artist_name,
            'categorie' => ucwords(trim($request->categorie)),
            'style' => $request->style ? ucwords(trim($request->style)) : null,
            'prix' => $request->prix,
            'largeur' => $request->largeur,
            'hauteur' => $request->hauteur,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.oeuvres')
            ->with('success', 'Œuvre mise à jour');
    }

    public function publicIndex(Request $request)
    {
        $query = Oeuvre::where('is_published', true);

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('titre', 'like', "%{$request->search}%")
                    ->orWhere('artist_name', 'like', "%{$request->search}%");
            });
        }

        if ($request->filled('categorie')) {
            $query->where('categorie', $request->categorie);
        }

        $oeuvres = $query->latest()->paginate(16);

        $categories = Oeuvre::where('is_published', true)
            ->pluck('categorie')
            ->unique();

        return view('oeuvres.index', compact('oeuvres', 'categories'));
    }

    public function peintures(Request $request)
    {
        $query = Oeuvre::where('is_published', true)
            ->whereRaw('LOWER(categorie) = ?', ['peinture']);

        if ($request->filled('style')) {
            $query->where('style', strtolower($request->style));
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('titre', 'like', "%{$request->search}%")
                    ->orWhere('artist_name', 'like', "%{$request->search}%");
            });
        }

        $oeuvres = $query->latest()->paginate(16);

        $styles = Oeuvre::where('is_published', true)
            ->whereRaw('LOWER(categorie) = ?', ['peinture'])
            ->whereNotNull('style')
            ->distinct()
            ->pluck('style');

        $categories = Oeuvre::where('is_published', true)
            ->select('categorie')
            ->distinct()
            ->pluck('categorie');

        return view('peintures.index', compact('oeuvres', 'styles', 'categories'));
    }

    public function show(Oeuvre $oeuvre)
    {
        return view('admin.oeuvres.show', compact('oeuvre'));
    }

    public function showPublic(Oeuvre $oeuvre)
    {
        if (!$oeuvre->is_published) {
            abort(404);
        }

        $vendeur = User::find($oeuvre->user_id);

        return view('oeuvres.show', compact('oeuvre', 'vendeur'));
    }

    public function destroy(Oeuvre $oeuvre)
    {
        if ($oeuvre->image && \Storage::disk('public')->exists($oeuvre->image)) {
            \Storage::disk('public')->delete($oeuvre->image);
        }

        $oeuvre->delete();

        return redirect()
            ->route('admin.oeuvres')
            ->with('success', 'Œuvre supprimée avec succès');
    }

    public function peintureSuggestions(Request $request)
    {
        if (!$request->search) {
            return response()->json([]);
        }

        return Oeuvre::where('is_published', true)
            ->whereRaw('LOWER(categorie) = ?', ['peinture'])
            ->where('titre', 'like', "%{$request->search}%")
            ->limit(1)
            ->pluck('titre');
    }

    public function searchSuggestions(Request $request)
    {
        if (!$request->search) {
            return response()->json([]);
        }

        return Oeuvre::where('is_published', true)
            ->where('titre', 'like', "%{$request->search}%")
            ->limit(5)
            ->pluck('titre');
    }

    public function oeuvresByArtist(User $user)
    {
        $oeuvres = Oeuvre::where('user_id', $user->id)
            ->where('is_published', true)
            ->latest()
            ->get();

        if ($oeuvres->isEmpty()) {
            abort(404);
        }

        return view('oeuvres.by-artist', compact('user', 'oeuvres'));
    }
    public function artistes()
    {
        $artistes = \App\Models\User::whereHas('oeuvres', function ($q) {
            $q->where('is_published', true);
        })
            ->withCount(['oeuvres' => function ($q) {
                $q->where('is_published', true);
            }])
            ->with(['oeuvres' => function ($q) {
                $q->where('is_published', true)
                    ->latest()
                    ->take(3);
            }])
            ->get();

        return view('artistes.index', compact('artistes'));
    }
}
