<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Planètes
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('admin.planets.create') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md">
                Créer
            </a>

            <div class="mt-4 bg-white shadow-sm sm:rounded-lg p-4">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left py-2">Nom (FR)</th>
                            <th class="text-left py-2">Nom (EN)</th>
                            <th class="text-left py-2">Distance</th>
                            <th class="text-left py-2">Durée</th>
                            <th class="text-left py-2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($planets as $planet)
                            <tr class="border-b">
                                <td class="py-2">{{ $planet->name_fr }}</td>
                                <td class="py-2">{{ $planet->name_en }}</td>
                                <td class="py-2">{{ $planet->distance }}</td>
                                <td class="py-2">{{ $planet->duration }}</td>
                                <td class="py-2">
                                    <a href="{{ route('admin.planets.edit', $planet) }}" class="text-blue-600">Modifier</a>
                                    <form method="POST" action="{{ route('admin.planets.destroy', $planet) }}" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600"
                                                onclick="return confirm('Supprimer ?')">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $planets->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
