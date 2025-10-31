<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CrewMember;
use App\Http\Requests\CrewMemberRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CrewMemberController extends Controller
{
    public function index()
    {
        $members = CrewMember::latest()->paginate(12);
        return view('admin.crew.index', compact('members'));
    }

    public function create()
    {
        return view('admin.crew.create');
    }

    public function store(CrewMemberRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('crew', 'public');
        }
        CrewMember::create($data);
        return redirect()->route('admin.crew.index')->with('success', 'Membre ajouté.');
    }

    public function edit(CrewMember $crew)
    {
        return view('admin.crew.edit', compact('crew'));
    }

    public function update(CrewMemberRequest $request, CrewMember $crew)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            if ($crew->image_path && Storage::disk('public')->exists($crew->image_path)) {
                Storage::disk('public')->delete($crew->image_path);
            }
            $data['image_path'] = $request->file('image')->store('crew', 'public');
        }
        $crew->update($data);
        return redirect()->route('admin.crew.index')->with('success', 'Membre modifié.');
    }

    public function destroy(CrewMember $crew)
    {
        if ($crew->image_path && Storage::disk('public')->exists($crew->image_path)) {
            Storage::disk('public')->delete($crew->image_path);
        }
        $crew->delete();
        return back()->with('success', 'Membre supprimé.');
    }
}
