<?php

namespace App\Http\Controllers;

use App\Models\Oeuvre;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

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
            'prix' => 'required|numeric',
            'largeur' => 'nullable|numeric',
            'hauteur' => 'nullable|numeric',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
        ]);

        $imagePath = $request->hasFile('image')
            ? $request->file('image')->store('oeuvres', 'public')
            : null;

        Oeuvre::create([
            'user_id' => Auth::id(),
            'titre' => $request->titre,
            'artist_name' => $request->artist_name,
            'categorie' => $request->categorie,
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

    private function authorizeOeuvre(Oeuvre $oeuvre)
    {
        $user = Auth::user();

        if ($user->hasRole('super_admin')) {
            return true;
        }

        if ($oeuvre->user_id !== $user->id) {
            abort(403);
        }

        return true;
    }

    public function show(Oeuvre $oeuvre)
    {
        $this->authorizeOeuvre($oeuvre);
        return view('admin.oeuvres.show', compact('oeuvre'));
    }

    public function edit(Oeuvre $oeuvre)
    {
        $this->authorizeOeuvre($oeuvre);
        return view('admin.oeuvres.edit', compact('oeuvre'));
    }

    public function update(Request $request, Oeuvre $oeuvre)
    {
        $this->authorizeOeuvre($oeuvre);

        $request->validate([
            'titre' => 'required|string',
            'artist_name' => 'required|string',
            'categorie' => 'required|string',
            'prix' => 'required|numeric',
            'largeur' => 'nullable|numeric',
            'hauteur' => 'nullable|numeric',
            'description' => 'nullable|string',
        ]);

        $oeuvre->update($request->only([
            'titre',
            'artist_name',
            'categorie',
            'prix',
            'largeur',
            'hauteur',
            'description',
        ]));

        return redirect()->route('admin.oeuvres.show', $oeuvre)
            ->with('success', 'Œuvre mise à jour');
    }

    public function destroy(Oeuvre $oeuvre)
    {
        $this->authorizeOeuvre($oeuvre);

        if ($oeuvre->image) {
            Storage::disk('public')->delete($oeuvre->image);
        }

        $oeuvre->delete();

        return redirect()->route('admin.oeuvres')
            ->with('success', 'Œuvre supprimée');
    }

    public function publicIndex()
    {
        $oeuvres = Oeuvre::where('is_published', true)
            ->latest()
            ->paginate(16);

        return view('oeuvres.index', compact('oeuvres'));
    }

    public function peintures()
    {
        $oeuvres = Oeuvre::where('is_published', true)
            ->where('categorie', 'Peinture')
            ->latest()
            ->paginate(16);

        return view('peintures.index', compact('oeuvres'));
    }

    public function artistes()
    {
        $artistes = User::whereHas('oeuvres', function ($q) {
            $q->where('is_published', true);
        })
            ->with(['oeuvres' => function ($q) {
                $q->where('is_published', true);
            }])
            ->withCount(['oeuvres' => function ($q) {
                $q->where('is_published', true);
            }])
            ->get();

        return view('artistes.index', compact('artistes'));
    }

    public function showPublic(Oeuvre $oeuvre)
    {
        if (!$oeuvre->is_published) {
            abort(404);
        }

        $oeuvre->increment('total_views');

        if (Auth::check()) {
            $alreadyViewed = DB::table('oeuvre_views')
                ->where('oeuvre_id', $oeuvre->id)
                ->where('user_id', Auth::id())
                ->exists();

            if (!$alreadyViewed) {
                DB::table('oeuvre_views')->insert([
                    'oeuvre_id' => $oeuvre->id,
                    'user_id' => Auth::id(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $oeuvre->increment('unique_views');
            }
        }

        return view('oeuvres.show', compact('oeuvre'));
    }

    public function toggleFavorite(Oeuvre $oeuvre)
    {
        $user = Auth::user();

        $exists = $user->favorites()
            ->where('oeuvre_id', $oeuvre->id)
            ->exists();

        if ($exists) {
            $user->favorites()->detach($oeuvre->id);
            return response()->json(['status' => 'removed']);
        }

        $user->favorites()->attach($oeuvre->id);
        return response()->json(['status' => 'added']);
    }

    public function toggleFavoriteAjax(Oeuvre $oeuvre)
    {
        $user = Auth::user();

        $isFavorite = $user->favorites()
            ->where('oeuvre_id', $oeuvre->id)
            ->exists();

        if ($isFavorite) {
            $user->favorites()->detach($oeuvre->id);
            $status = false;
        } else {
            $user->favorites()->attach($oeuvre->id);
            $status = true;
        }

        return response()->json([
            'success' => true,
            'favorite' => $status,
            'oeuvre_id' => $oeuvre->id
        ]);
    }
}
