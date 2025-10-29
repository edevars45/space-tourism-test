<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlanetRequest;
use App\Models\Planet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PlanetController extends Controller
{
    /**
     * Liste paginée des planètes.
     */
    public function index(): View
    {
        $planets = Planet::latest()->paginate(10);
        return view('admin/planets/index', compact('planets'));
    }

    /**
     * Formulaire de création.
     */
    public function create(): View
    {
        $planet = new Planet();
        return view('admin.planets.create', compact('planet'));
    }

    /**
     * Enregistre une planète.
     */
    public function store(PlanetRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // Upload image si fournie
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('planets', 'public'); // ex: storage/app/public/planets/xxx.jpg
        }

        Planet::create($data);

        return redirect()
            ->route('admin.planets.index')
            ->with('status', 'Planète créée avec succès.');
    }

    /**
     * Formulaire d’édition.
     */
    public function edit(Planet $planet): View
    {
        return view('admin.planets.edit', compact('planet'));
    }

    /**
     * Met à jour une planète.
     */
    public function update(PlanetRequest $request, Planet $planet): RedirectResponse
    {
        $data = $request->validated();

        // Nouvelle image => on supprime l’ancienne si elle existe
        if ($request->hasFile('image')) {
            if (!empty($planet->image) && Storage::disk('public')->exists($planet->image)) {
                Storage::disk('public')->delete($planet->image);
            }
            $data['image'] = $request->file('image')->store('planets', 'public');
        }

        $planet->update($data);

        return redirect()
            ->route('admin.planets.index')
            ->with('status', 'Planète mise à jour avec succès.');
    }

    /**
     * Supprime une planète (et son image associée).
     */
    public function destroy(Planet $planet): RedirectResponse
    {
        // Supprime le fichier image s’il existe
        if (!empty($planet->image) && Storage::disk('public')->exists($planet->image)) {
            Storage::disk('public')->delete($planet->image);
        }

        $planet->delete();

        return redirect()
            ->route('admin.planets.index')
            ->with('status', 'Planète supprimée avec succès.');
    }
}
