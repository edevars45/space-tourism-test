<x-layout>
    <x-slot:bgImage>
        {{ asset('images/background-destination.png') }}
    </x-slot:bgImage>

    <x-header />

    <main class="min-h-screen bg-[#0B0D17] text-white px-6 pt-20 lg:px-16 lg:pt-28">

        <!-- Conteneur principal -->
        <div class="max-w-7xl mx-auto flex flex-col-reverse gap-10 lg:gap-16 lg:flex-row lg:items-center lg:justify-between">

            <!-- Colonne gauche : texte -->
            <section class="w-full lg:w-1/2 flex flex-col gap-8">

                <!-- En-tête -->
                <p class="uppercase tracking-widest text-sm text-blue-200">
                    <span class="opacity-50 mr-2">{{ __('equipage.section_number') }}</span>
                    {{ __('equipage.section_title') }}
                </p>

                <!-- Bloc texte -->
                <div class="text-center lg:text-left flex flex-col gap-4">
                    <p class="uppercase tracking-widest text-xs lg:text-sm text-blue-200">
                        {{ __('equipage.role') }}
                    </p>

                    <h1 class="text-4xl md:text-6xl font-serif uppercase">
                        {{ __('equipage.name') }}
                    </h1>

                    <p class="max-w-xl text-blue-100 leading-relaxed mx-auto lg:mx-0">
                        {{ __('equipage.description') }}
                    </p>
                </div>

                <!-- Pagination -->
                <div class="flex justify-center lg:justify-start gap-4 mt-6">
                    <button class="w-3 h-3 rounded-full bg-white" title="{{ __('equipage.pagination_1') }}"></button>
                    <button class="w-3 h-3 rounded-full bg-white/30 hover:bg-white transition" title="{{ __('equipage.pagination_2') }}"></button>
                    <button class="w-3 h-3 rounded-full bg-white/30 hover:bg-white transition" title="{{ __('equipage.pagination_3') }}"></button>
                    <button class="w-3 h-3 rounded-full bg-white/30 hover:bg-white transition" title="{{ __('equipage.pagination_4') }}"></button>
                </div>
            </section>

            <!-- Colonne droite : image -->
            <aside class="w-full lg:w-1/2 flex justify-center">
                <img
                    src="{{ asset('images/image-douglas-hurley.png') }}"
                    alt="{{ __('equipage.image_alt') }}"
                    class="w-full max-w-md lg:max-w-[480px] xl:max-w-[520px] h-auto object-contain"
                />
            </aside>

        </div>
    </main>
</x-layout>
