<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlanetRequest;
use App\Models\Planet;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Attributes\Middleware; // J’utilise les attributs (Laravel 12) pour déclarer les middlewares

#[Middleware('auth')] // J’exige l’authentification pour tout le contrôleur
class PlanetController extends Controller
{
    // J’applique les permissions par action (Spatie)
    #[Middleware('permission:planets.view', only: ['index'])]
    #[Middleware('permission:planets.create', only: ['create','store'])]
    #[Middleware('permission:planets.edit', only: ['edit','update'])]
    #[Middleware('permission:planets.delete', only: ['destroy'])]
    public function __construct()
    {
        // Je ne mets rien ici : avec Laravel 12, je préfère les attributs ci-dessus
    }

    /**
     * J’affiche la liste paginée des planètes (back-office).
     */
    public function index(): View
    {
        $planets = Planet::latest()->paginate(10);
        return view('admin.planets.index', compact('planets'));
    }

    /**
     * J’affiche le formulaire de création.
     */
    public function create(): View
    {
        return view('admin.planets.create');
    }

    /**
     * J’enregistre une nouvelle planète après validation.
     * - Je stocke l’image dans storage/app/public/planets si fournie.
     * - Je purge le cache tagué ‘planets’ pour rafraîchir le site public.
     */
    public function store(PlanetRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('planets', 'public');
        }

        Planet::create($data);

        Cache::tags(['planets'])->flush(); // j’invalide le cache public
        return redirect()->route('admin.planets.index')->with('status', 'Planète créée.');
    }

    /**
     * J’affiche le formulaire d’édition.
     */
    public function edit(Planet $planet): View
    {
        return view('admin.planets.edit', compact('planet'));
    }

    /**
     * Je mets à jour la planète.
     * - Si une nouvelle image est envoyée, je supprime l’ancienne.
     * - Je purge le cache public après mise à jour.
     */
    public function update(PlanetRequest $request, Planet $planet): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($planet->image) {
                Storage::disk('public')->delete($planet->image); // je nettoie l’ancienne image
            }
            $data['image'] = $request->file('image')->store('planets', 'public');
        }

        $planet->update($data);

        Cache::tags(['planets'])->flush(); // j’invalide le cache public
        return redirect()->route('admin.planets.index')->with('status', 'Planète mise à jour.');
    }

    /**
     * Je supprime la planète (et son image si présente), puis je purge le cache public.
     */
    public function destroy(Planet $planet): RedirectResponse
    {
        if ($planet->image) {
            Storage::disk('public')->delete($planet->image);
        }

        $planet->delete();

        Cache::tags(['planets'])->flush(); // j’invalide le cache public
        return redirect()->route('admin.planets.index')->with('status', 'Planète supprimée.');
    }
}
