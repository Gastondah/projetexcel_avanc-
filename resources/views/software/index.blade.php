<x-layout>
    <div class="bg-white min-h-screen relative flex" 
         x-data="{ 
            openSidebar: true, 
            {{-- Correction ici : on prend simplement le premier de la liste --}}
            activeSoftware: @js($softwares->first()) 
         }">
        
        <aside 
            :class="openSidebar ? 'w-80' : 'w-0'" 
            class="bg-slate-50 border-r border-emerald-100 sticky top-20 h-[calc(100vh-80px)] transition-all duration-300 overflow-hidden z-30 shadow-xl"
        >
            <div class="w-80 p-6 overflow-y-auto h-full">
                <h3 class="text-[10px] font-black text-emerald-600 uppercase tracking-[0.3em] mb-8 italic">Catalogue Logiciels</h3>
                
                <div class="space-y-2">
                    {{-- Correction ici : On groupe les logiciels par leur nom de catégorie ou 'Autres Outils' s'ils n'en ont pas --}}
                    @foreach($softwares->groupBy(fn($item) => $item->category ?: 'Autres Outils') as $category => $items)
                    <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative group">
                        
                        <div :class="open ? 'bg-emerald-500 shadow-lg' : 'text-slate-700 hover:bg-emerald-50'" 
                             class="flex items-center justify-between px-4 py-3 rounded-md transition-all duration-200 cursor-pointer">
                            <div class="flex items-center gap-3">
                                <span :class="open ? 'bg-white text-emerald-600' : 'bg-emerald-100 text-emerald-600'" 
                                      class="w-6 h-6 text-[10px] font-black rounded-md flex items-center justify-center flex-shrink-0">
                                    {{ $loop->iteration }}
                                </span>
                                <span :class="open ? 'text-white' : 'text-slate-700'" class="text-[11px] font-black uppercase tracking-widest">
                                    {{ $category }}
                                </span>
                            </div>
                            <svg :class="open ? 'rotate-90 text-white' : 'text-slate-400'" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>

                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             class="mt-1 ml-4 border-l-2 border-emerald-200 pl-4 space-y-1 mb-4 pr-4">
                            @foreach($items as $item)
                                <button 
                                    @click="activeSoftware = @js($item)"
                                    class="flex items-start text-left gap-2 py-2 px-2 rounded-sm hover:bg-white hover:shadow-sm transition group/item w-full"
                                    :class="(activeSoftware && activeSoftware.id === {{ $item->id }}) ? 'bg-white shadow-sm border-r-4 border-emerald-500' : ''"
                                >
                                    <span class="text-[11px] font-bold text-slate-500 group-hover/item:text-emerald-700 leading-tight block"
                                          :class="activeSoftware && activeSoftware.id === {{ $item->id }} ? 'text-emerald-700' : ''">
                                        {{ $item->name }}
                                    </span>
                                </button>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </aside>

        {{-- Le reste du code (Main, Header, Description, etc.) reste identique à votre version --}}
        <button @click="openSidebar = !openSidebar" class="fixed bottom-10 left-10 z-50 w-12 h-12 bg-slate-900 text-white rounded-full shadow-2xl flex items-center justify-center hover:bg-emerald-500 transition-colors border-2 border-white">
            <svg x-show="!openSidebar" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16m-7 6h7" stroke-width="2" stroke-linecap="round"/></svg>
            <svg x-show="openSidebar" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-width="2" stroke-linecap="round"/></svg>
        </button>

        <main class="flex-grow py-16 px-6 md:px-12 bg-white">
            <div class="max-w-4xl mx-auto" x-show="activeSoftware" x-transition:enter="transition duration-500">
                <header class="mb-12">
                    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 border-b border-slate-100 pb-8">
                        <div>
                            <span class="text-emerald-500 font-black text-[10px] tracking-[0.3em] uppercase mb-2 block italic" x-text="activeSoftware.category || 'Expert Logiciel'"></span>
                            <h1 class="text-5xl font-black text-slate-900 tracking-tighter uppercase leading-none" x-text="activeSoftware.name"></h1>
                        </div>
                        <div class="bg-emerald-100 text-emerald-700 font-black px-6 py-3 rounded-md text-2xl" x-text="activeSoftware.price > 0 ? parseFloat(activeSoftware.price).toFixed(2) + ' €' : 'GRATUIT'"></div>
                    </div>
                </header>

                <div class="prose prose-slate max-w-none mb-12">
                    <h3 class="text-xs font-black uppercase tracking-widest text-slate-400 mb-4 italic">À propos de ce logiciel</h3>
                    <div class="bg-slate-50 p-8 rounded-md border-l-4 border-emerald-500 text-slate-600 text-lg leading-relaxed" x-html="activeSoftware.description"></div>
                </div>

                <div class="mb-12">
                    <h3 class="text-xs font-black uppercase tracking-widest text-slate-400 mb-6 italic text-center">Démonstration Vidéo</h3>
                    <div class="shadow-2xl rounded-md overflow-hidden bg-slate-900 aspect-video">
                        <iframe 
                            class="w-full h-full" 
                            :src="'https://www.youtube.com/embed/' + activeSoftware.video_demo_id + '?rel=0&modestbranding=1'" 
                            frameborder="0" 
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>

                <div class="mb-24">
                    <a :href="'/software/download/' + activeSoftware.id" 
                       class="flex items-center justify-center gap-4 w-full bg-slate-900 text-white px-8 py-6 rounded-md font-black text-sm tracking-[0.2em] uppercase hover:bg-emerald-600 transition-all duration-300 shadow-xl group">
                        <svg class="w-6 h-6 transition-transform group-hover:scale-125" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        <span x-text="activeSoftware.price > 0 ? 'Acheter et Télécharger' : 'Télécharger Gratuitement'"></span>
                    </a>
                    <p class="text-center text-slate-400 text-[10px] mt-4 font-bold uppercase tracking-widest">Format .xlsm sécurisé • Guide d'utilisation inclus</p>
                </div>

                <template x-if="activeSoftware.screenshots && activeSoftware.screenshots.length > 0">
                    <section class="mt-20 border-t border-slate-100 pt-16">
                        <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest mb-12 flex items-center gap-4">
                            <span class="w-12 h-[2px] bg-emerald-500"></span>
                            Fonctionnalités détaillées
                        </h3>

                        <div class="space-y-20">
                            <template x-for="(shot, index) in activeSoftware.screenshots" :key="index">
                                <div class="group">
                                    <div class="flex flex-col gap-6">
                                        <div class="flex items-center gap-4">
                                            <span class="bg-slate-900 text-white w-8 h-8 rounded-md flex items-center justify-center text-xs font-black shadow-lg" x-text="index + 1"></span>
                                            <h4 class="text-2xl font-black text-slate-800 uppercase tracking-tight group-hover:text-emerald-600 transition-colors" x-text="shot.title"></h4>
                                        </div>
                                        
                                        <div class="relative rounded-lg overflow-hidden border border-slate-200 shadow-sm hover:shadow-2xl transition-all duration-500">
                                            <img :src="'{{ asset('storage') }}/' + shot.image" :alt="shot.title" class="w-full h-auto object-cover">
                                        </div>

                                        <div class="bg-emerald-50/50 p-6 rounded-md border-r-4 border-emerald-200">
                                            <p class="text-slate-600 leading-relaxed font-medium" x-text="shot.description"></p>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </section>
                </template>
            </div>

            <div x-show="!activeSoftware" class="text-center py-40">
                <p class="text-slate-400 font-bold italic text-xl uppercase tracking-widest">Aucun logiciel disponible pour le moment.</p>
            </div>
        </main>
    </div>
</x-layout>