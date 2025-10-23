<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlanetRequest;
use App\Models\Planet;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PlanetController extends Controller
{
    // Les routes protègent déjà via ['auth','can:admin'].

    public function index(): View
    {
        $planets = Planet::latest()->paginate(10);
        return view('admin.planets.index', compact('planets'));
    }

    public function create(): View
    {
        $planet = new Planet();
        return view('admin.planets.create', compact('planet'));
    }

    public function store(PlanetRequest $request): RedirectResponse
    {
        Planet::create($request->validated());
        return redirect()->route('admin.planets.index')->with('status', 'Planète créée.');
    }

    public function edit(Planet $planet): View
    {
        return view('admin.planets.edit', compact('planet'));
    }

    public function update(PlanetRequest $request, Planet $planet): RedirectResponse
    {
        $planet->update($request->validated());
        return redirect()->route('admin.planets.index')->with('status', 'Planète mise à jour.');
    }

    public function destroy(Planet $planet): RedirectResponse
    {
        $planet->delete();
        return redirect()->route('admin.planets.index')->with('status', 'Planète supprimée.');
    }
}
