<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Modifier un membre</h2>
    </x-slot>

    <form action="{{ route('admin.crew.update', $crew) }}" method="POST" enctype="multipart/form-data" class="p-6">
        @method('PUT')
        @include('admin.crew._form', ['crew' => $crew])
    </form>
</x-app-layout>
