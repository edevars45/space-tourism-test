<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CrewMember;
use App\Http\Requests\CrewMemberRequest;
use Illuminate\Support\Facades\Storage;

class CrewMemberController extends Controller
{
    /**
     * Liste paginée des membres (back-office).
     */
    public function index()
    {
        // On trie du plus récent au plus ancien pour voir les ajouts en haut.
        $members = CrewMember::latest()->paginate(12);

        return view('admin.crew.index', compact('members'));
    }

    /**
     * Formulaire de création.
     * On passe un modèle vide au partial pour éviter les 'undefined'.
     */
    public function create()
    {
        $crew = new CrewMember(); // modèle vide pour le _form
        return view('admin.crew.create', compact('crew'));
    }

    /**
     * Enregistrement d’un nouveau membre.
     * - Valide via CrewMemberRequest
     * - Stocke l’image dans storage/app/public/crew
     * - Sauvegarde le chemin en base dans la colonne 'image'
     */
    public function store(CrewMemberRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            // Ex: 'crew/abc.jpg', accessible via asset('storage/'.$path)
            $data['image'] = $request->file('image')->store('crew', 'public');
        }

        CrewMember::create($data);

        return to_route('admin.crew.index')->with('success', 'Membre ajouté.');
    }

    /**
     * Formulaire d’édition.
     * Route model binding injecte le CrewMember ciblé.
     */
    public function edit(CrewMember $crew)
    {
        return view('admin.crew.edit', compact('crew'));
    }

    /**
     * Mise à jour d’un membre.
     * - Valide les données
     * - Remplace l’image si un nouveau fichier est soumis
     * - Ne touche pas à l’image si aucun fichier n’est envoyé
     */
    public function update(CrewMemberRequest $request, CrewMember $crew)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            // Supprimer l’ancienne image si elle existe physiquement
            if ($crew->image && Storage::disk('public')->exists($crew->image)) {
                Storage::disk('public')->delete($crew->image);
            }

            // Enregistrer la nouvelle image
            $data['image'] = $request->file('image')->store('crew', 'public');
        } else {
            // Évite d’écraser la valeur existante s’il n’y a pas de nouveau fichier
            unset($data['image']);
        }

        $crew->update($data);

        return to_route('admin.crew.index')->with('success', 'Membre modifié.');
    }

    /**
     * Suppression d’un membre.
     * - Efface l’image associée si elle existe
     * - Supprime la ligne en base
     */
    public function destroy(CrewMember $crew)
    {
        if ($crew->image && Storage::disk('public')->exists($crew->image)) {
            Storage::disk('public')->delete($crew->image);
        }

        $crew->delete();

        return back()->with('success', 'Membre supprimé.');
    }
}
