<x-layout>
    <div class="bg-white min-h-screen relative flex" x-data="{ openSidebar: true }">
        
        <aside 
            :class="openSidebar ? 'w-80' : 'w-0'" 
            class="bg-slate-50 border-r border-emerald-100 sticky top-20 h-[calc(100vh-80px)] transition-all duration-300 overflow-hidden z-30 shadow-xl"
        >
            <div class="w-80 p-6 overflow-y-auto h-full">
                <h3 class="text-[10px] font-black text-emerald-600 uppercase tracking-[0.3em] mb-8 italic">Index des cours</h3>
                
                @php
                    $categories = [
                        'maitriser-excel' => 'Maîtriser Excel',
                        'programmation-vba' => 'Programmation VBA',
                        'bibliotheque-fonctions' => 'Bibliothèque de Fonctions',
                        'scripts-automatisation' => 'Scripts & Automatisation',
                        'tableaux-de-bord' => 'Tableaux de Bord',
                        'power-query' => 'Power Query',
                        'gestion-projet-info' => 'Gestion de Projet Informatique' // 7ème catégorie ajoutée
                    ];
                @endphp

                <div class="space-y-2">
                    @foreach($categories as $slug => $name)
                    <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative group">
                        
                        <div :class="open ? 'bg-emerald-500 shadow-lg' : 'text-slate-700 hover:bg-emerald-50'" 
                            class="flex items-center justify-between px-4 py-3 rounded-md transition-all duration-200">
                            
                            <div class="flex items-center gap-3 w-full">
                                <span :class="open ? 'bg-white text-emerald-600' : 'bg-emerald-100 text-emerald-600'" 
                                    class="w-6 h-6 text-[10px] font-black rounded-md flex items-center justify-center flex-shrink-0">
                                    {{ $loop->iteration }}
                                </span>

                                <a href="/blog?category={{ $slug }}" 
                                :class="open ? 'text-white' : 'text-slate-700'"
                                class="text-[11px] font-black uppercase tracking-widest block w-full">
                                    {{ $name }}
                                </a>
                            </div>

                            <svg :class="open ? 'rotate-90 text-white' : 'text-slate-400'" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>

                        <div x-show="open" 
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 -translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="mt-1 ml-4 border-l-2 border-emerald-200 pl-4 space-y-1 mb-4 pr-4">
                            
                            @foreach($allArticles->where('category', $slug) as $navArticle)

                                <a href="{{ route('articles.show', $navArticle->slug) }}" 
                                class="flex items-start gap-2 py-2 px-2 rounded-sm hover:bg-white hover:shadow-sm transition group/item w-full">
                                    
                                    <span class="text-[10px] font-bold text-emerald-500 mt-1 min-w-[15px]">
                                        {{ $loop->iteration }}.
                                    </span>

                                    <span class="text-[11px] font-bold text-slate-500 group-hover/item:text-emerald-700 leading-tight block break-words">
                                        {{ $navArticle->title }}
                                    </span>
                                </a>
                            @endforeach

                            @if($articles->where('category', $slug)->count() == 0)
                                <span class="text-[10px] italic text-slate-400 px-2 block">Aucun article disponible</span>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </aside>
        <button 
            @click="openSidebar = !openSidebar"
            class="fixed bottom-10 left-10 z-50 w-12 h-12 bg-slate-900 text-white rounded-full shadow-2xl flex items-center justify-center hover:bg-emerald-500 transition-colors border-2 border-white"
        >
            <svg x-show="!openSidebar" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
            <svg x-show="openSidebar" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>

        <main class="flex-grow py-16 px-10">
            <div class="max-w-6xl mx-auto">
                <header class="mb-12">
                    <h1 class="text-5xl font-black text-slate-900 tracking-tighter uppercase">
                        ARTICLE <span class="text-emerald-500">Expert</span>
                    </h1>
                </header>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    @foreach($articles as $article)
                        <div class="bg-white p-2 rounded-md border border-slate-100 hover:border-emerald-200 hover:shadow-xl transition-all duration-300 group flex gap-6 items-center">
                            <!--
                            <div class="w-40 h-40 rounded-[1.5rem] overflow-hidden flex-shrink-0">
                                <img src="{{ asset('storage/' . $article->image_cover) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            </div>
                            -->
                            <div class="w-40 h-40 rounded-sm overflow-hidden flex-shrink-0">
                                <img src="{{ $article->image_cover ? asset('storage/' . $article->image_cover) : 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=800' }}" 
                                    class="w-full h-full object-cover group-hover:scale-110 transition duration-500"
                                    alt="{{ $article->title }}">
                            </div>
                            <div class="pr-6">
                                <span class="text-[9px] font-black text-emerald-500 uppercase tracking-widest">{{ $categories[$article->category] ?? $article->category }}</span>
                                <h2 class="text-xl font-bold text-slate-800 leading-tight mt-1 group-hover:text-emerald-600">
                                    {{ $article->title }}
                                </h2>
                                <!--
                                <a href="{{ route('articles.show', $article->slug) }}" class="inline-flex items-center gap-2 mt-4 text-[10px] font-black uppercase text-slate-400 group-hover:text-emerald-600 transition">
                                    Lire l'article
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                                </a>
                            -->
                            <a href="{{ route('articles.show', $article->slug) }}" class="flex items-center gap-2 bg-[#f0f9f4] text-[#217346] px-5 py-2.5 rounded-md font-black text-[10px] tracking-widest uppercase transition-all duration-300 hover:bg-[#217346] hover:text-white group/btn">
                                Lire l'article
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 transition-transform group-hover/btn:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-16">
                    {{ $articles->links() }}
                </div>
            </div>
        </main>
    </div>
</x-layout>