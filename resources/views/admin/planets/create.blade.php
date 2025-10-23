<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Créer une planète
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('admin.planets.store') }}" enctype="multipart/form-data">
                    @csrf
                    @include('admin.planets._form', ['planet' => null])
                    <button type="submit" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-md">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
