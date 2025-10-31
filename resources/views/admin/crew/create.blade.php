<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Ajouter un membre</h2>
    </x-slot>

    <form action="{{ route('admin.crew.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
        @include('admin.crew._form', ['crew' => new \App\Models\CrewMember()])
    </form>
</x-app-layout>