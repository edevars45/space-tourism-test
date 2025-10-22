<x-layout>
    <x-slot:bgImage>
        {{ asset('images/background-technology-desktop.jpg') }}
    </x-slot:bgImage>

    <x-header />

    <main class="min-h-screen bg-[#0B0D17] text-white px-6 pt-20 lg:px-16 lg:pt-28">

        <!-- Conteneur principal -->
        <div class="max-w-7xl mx-auto flex flex-col-reverse gap-10 lg:gap-16 lg:flex-row lg:items-center lg:justify-between">

            <!-- Colonne gauche : contenu -->
            <section class="w-full lg:w-1/2 flex flex-col gap-8">

                <!-- Titre principal -->
                <p class="uppercase tracking-widest text-sm text-blue-200">
                    <span class="opacity-50 mr-2">{{ __('technologies.section_number') }}</span>
                    {{ __('technologies.section_title') }}
                </p>

                <div class="flex flex-col lg:flex-row gap-8">
                    <!-- Cercles -->
                    <nav aria-label="Choix de technologie"
                        class="flex justify-center lg:justify-start items-center gap-4 lg:flex-col lg:gap-6">
                        <a href="#step1"
                            class="flex items-center justify-center w-12 h-12 lg:w-16 lg:h-16 rounded-full border border-white/70
                                   text-base lg:text-xl font-medium tracking-wide hover:bg-white hover:text-black transition
                                   bg-white text-black">
                            {{ __('technologies.circle_1') }}
                        </a>
                        <a href="#step2"
                            class="flex items-center justify-center w-12 h-12 lg:w-16 lg:h-16 rounded-full border border-white/70
                                   text-base lg:text-xl font-medium tracking-wide hover:bg-white hover:text-black transition">
                            {{ __('technologies.circle_2') }}
                        </a>
                        <a href="#step3"
                            class="flex items-center justify-center w-12 h-12 lg:w-16 lg:h-16 rounded-full border border-white/70
                                   text-base lg:text-xl font-medium tracking-wide hover:bg-white hover:text-black transition">
                            {{ __('technologies.circle_3') }}
                        </a>
                    </nav>

                    <!-- Contenu texte -->
                    <div class="flex-1 text-center lg:text-left flex flex-col gap-4">
                        <p class="uppercase tracking-widest text-xs lg:text-sm text-blue-200">
                            {{ __('technologies.subtitle') }}
                        </p>

                        <h1 class="text-4xl md:text-6xl font-serif uppercase">
                            {{ __('technologies.title') }}
                        </h1>

                        <p class="max-w-xl text-blue-100 leading-relaxed mx-auto lg:mx-0">
                            {{ __('technologies.paragraph') }}
                        </p>
                    </div>
                </div>
            </section>

            <!-- Colonne droite : image -->
            <aside class="w-full lg:w-1/2 flex justify-center">
                <img src="{{ asset('images/image-launch-vehicle-portrait.jpg') }}"
                    alt="{{ __('technologies.image_alt') }}"
                    class="w-full max-w-md lg:max-w-[480px] xl:max-w-[520px] h-auto object-contain" />
            </aside>
        </div>
    </main>
</x-layout>
