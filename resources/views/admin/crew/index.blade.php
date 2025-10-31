<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold">Équipage</h2>
    </x-slot>

    <div class="mb-4">
        <a href="{{ route('admin.crew.create') }}" class="btn">Ajouter un membre</a>
    </div>

    <table class="w-full border">
        <thead>
        <tr class="bg-gray-100">
            <th class="p-2 text-left">Nom ({{ app()->getLocale() }})</th>
            <th class="p-2 text-left">Rôle ({{ app()->getLocale() }})</th>
            <th class="p-2 text-center">Image</th>
            <th class="p-2 w-40 text-center">Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($members as $m)
            <tr class="border-t">
                <td class="p-2">{{ data_get($m->name, app()->getLocale()) }}</td>
                <td class="p-2">{{ data_get($m->role_title, app()->getLocale()) }}</td>
                <td class="p-2 text-center">
                    @if($m->image)
                        <img src="{{ asset('storage/'.$m->image) }}" class="h-12 mx-auto">
                    @endif
                </td>
                <td class="p-2 text-center">
                    <a href="{{ route('admin.crew.edit', $m) }}" class="text-blue-600">Éditer</a>
                    <form action="{{ route('admin.crew.destroy', $m) }}" method="POST"
                          class="inline" onsubmit="return confirm('Supprimer ?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 ml-2">Supprimer</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td class="p-4" colspan="4">Aucun membre.</td></tr>
        @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $members->links() }}
    </div>
</x-app-layout>