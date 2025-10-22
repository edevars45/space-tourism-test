<x-layout>
    <x-slot:bgImage>
        {{ asset('images/background-destination.png') }}
    </x-slot:bgImage>

    <x-header />

    <main class="min-h-screen text-white px-4 sm:px-6 md:px-8 lg:px-12 pt-16 sm:pt-20 text-center lg:text-left">

        <!-- Titre de section -->
        <p class="uppercase tracking-[0.3em] text-xs sm:text-sm md:text-base text-blue-200 mb-4 lg:mb-8 lg:mt-10">
            <span class="opacity-50 mr-3">{{ __('destinations.section_number') }}</span>
            {{ __('destinations.section_title') }}
        </p>

        <div class="flex flex-col lg:flex-row lg:justify-center gap-x-90">
            <!-- Image -->
            <img src="{{ asset('images/planete-lune.png') }}" alt="{{ __('destinations.moon') }}"
                class="w-auto sm:w-56 md:w-72 lg:w-[500px] xl:w-[580px] h-auto mb-6 sm:mb-8 lg:mb-0" />

            <div class="flex flex-col lg:flex-col">
                <!-- Navigation -->
                <nav
                    class="flex flex-wrap justify-center lg:justify-start gap-6 uppercase tracking-[0.2em] mb-4 sm:mb-6 border-b border-[#383B4B]/80 pb-3">
                    <a href="#" class="relative pb-2 text-white border-b-2 border-white">{{ __('destinations.moon') }}</a>
                    <a href="#" class="text-blue-200 hover:text-white transition-colors pb-2">{{ __('destinations.mars') }}</a>
                    <a href="#" class="text-blue-200 hover:text-white transition-colors pb-2">{{ __('destinations.europa') }}</a>
                    <a href="#" class="text-blue-200 hover:text-white transition-colors pb-2">{{ __('destinations.titan') }}</a>
                </nav>

                <!-- Nom de la planète -->
                <h1 class="font-serif uppercase text-5xl sm:text-6xl md:text-7xl lg:text-[92px] leading-none mb-4">
                    {{ __('destinations.moon') }}
                </h1>

                <!-- Description -->
                <p class="max-w-md lg:max-w-xl mx-auto lg:mx-0 text-blue-100/90 leading-relaxed text-sm sm:text-base md:text-lg mb-8">
                    {{ __('destinations.description_moon') }}
                </p>

                <div class="border-t border-[#383B4B]/80 mb-6 w-full max-w-md lg:max-w-xl mx-auto lg:mx-0"></div>

                <!-- Informations -->
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-8 uppercase tracking-[0.18em] text-blue-200 text-xs sm:text-sm md:text-base">
                    <div class="text-center lg:text-left">
                        <p class="mb-2">{{ __('destinations.distance_label') }}</p>
                        <p class="font-serif text-2xl sm:text-3xl md:text-4xl text-white tracking-normal">{{ __('destinations.distance_value') }}</p>
                    </div>
                    <div class="text-center lg:text-left">
                        <p class="mb-2">{{ __('destinations.duration_label') }}</p>
                        <p class="font-serif text-2xl sm:text-3xl md:text-4xl text-white tracking-normal">{{ __('destinations.duration_value') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>
