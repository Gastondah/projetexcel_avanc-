<x-layout>
    @php
        $categories = [
            'maitriser-excel' => 'Maîtriser Excel',
            'programmation-vba' => 'Programmation VBA',
            'bibliotheque-fonctions' => 'Bibliothèque de Fonctions',
            'scripts-automatisation' => 'Scripts & Automatisation'
        ];
        // On récupère tous les articles de la même catégorie pour la sidebar
        $relatedArticles = \App\Models\Article::where('category', $article->category)->orderBy('created_at', 'asc')->get();
    @endphp

    <div class="bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-6 py-12">
            <div class="flex flex-col lg:flex-row gap-12">
                
                <!--<main class="lg:w-3/4">
                    <div class="mb-8 flex justify-between items-center">
                        <a href="/blog?category={{ $article->category }}" 
                        class="group inline-flex items-center gap-3 bg-white border border-slate-200 text-slate-600 px-5 py-2.5 rounded-md font-black text-[10px] uppercase tracking-widest shadow-sm transition-all duration-300 hover:border-emerald-500 hover:text-emerald-600 hover:shadow-md hover:-translate-y-0.5">
                            
                            <span class="w-6 h-6 rounded-full bg-slate-100 flex items-center justify-center group-hover:bg-emerald-500 group-hover:text-white transition-colors duration-300">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                            </span>
                            
                            Retour à la liste
                        </a>

                        <div class="hidden md:flex items-center gap-2 text-[9px] font-bold text-slate-400 uppercase tracking-[0.2em]">
                            <span>Cours</span>
                            <span class="text-emerald-300">/</span>
                            <span class="text-slate-900">{{ $categories[$article->category] ?? $article->category }}</span>
                        </div>
                    </div>

                    <article class="bg-white rounded-md shadow-sm border border-slate-100 overflow-hidden">
                        <div class="h-[400px] w-full relative">
                            <img src="{{ $article->image_cover ? asset('storage/' . $article->image_cover) : 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=1200' }}" 
                                class="w-full h-full object-cover" 
                                alt="{{ $article->title }}">
                            
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex flex-col justify-end p-12">
                                <span class="bg-emerald-500 text-white text-[10px] font-black px-4 py-1.5 rounded-full uppercase tracking-widest w-fit mb-4">
                                    {{ $categories[$article->category] ?? $article->category }}
                                </span>
                                <h1 class="text-4xl md:text-5xl font-black text-white leading-tight uppercase tracking-tighter">
                                    {{ $article->title }}
                                </h1>
                            </div>
                        </div>
                    </article>
                </main> -->
                <main class="lg:w-3/4">
                    <div class="mb-8 flex flex-col gap-6">
                        <a href="/blog" 
                        class="group inline-flex items-center gap-3 bg-white border border-slate-200 text-slate-600 px-5 py-2.5 rounded-md font-black text-[10px] uppercase tracking-widest shadow-sm transition-all duration-300 hover:border-emerald-500 hover:text-emerald-600 w-fit">
                            Retour à la liste
                        </a>

                        <div>
                            <span class="text-emerald-500 font-black text-[10px] tracking-widest uppercase mb-2 block">
                                {{ $categories[$article->category] ?? $article->category }}
                            </span>
                            <h1 class="text-4xl md:text-5xl font-black text-slate-900 leading-tight uppercase tracking-tighter">
                                {{ $article->title }}
                            </h1>
                        </div>
                    </div>

                    <article class="bg-white rounded-md shadow-sm border border-slate-100 overflow-hidden p-8 md:p-12">
                        <div class="h-[350px] w-full rounded-md overflow-hidden mb-12">
                            <img src="{{ $article->image_cover ? asset('storage/' . $article->image_cover) : asset('images/default-blog.jpg') }}" 
                                class="w-full h-full object-cover" 
                                alt="{{ $article->title }}">
                        </div>

                        <div class="prose prose-slate max-w-none mb-16 text-slate-600 leading-relaxed text-lg">
                            {!! $article->content !!}
                        </div>

                        @if($article->sections && count($article->sections) > 0)
                            <div class="space-y-16 mt-16 border-t border-slate-100 pt-16">
                                @foreach($article->sections as $section)
                                    <div class="group">
                                        <div class="flex flex-col gap-6">
                                            <div class="flex items-center gap-4">
                                                <span class="bg-slate-900 text-white w-8 h-8 rounded-md flex items-center justify-center text-xs font-black">{{ $loop->iteration }}</span>
                                                <h4 class="text-2xl font-black text-slate-800 uppercase tracking-tight">{{ $section['title'] ?? '' }}</h4>
                                            </div>
                                            
                                            @if(!empty($section['image']))
                                                <div class="relative rounded-lg overflow-hidden border border-slate-200 shadow-sm">
                                                    <img src="{{ asset('storage/' . $section['image']) }}" class="w-full h-auto">
                                                </div>
                                            @endif

                                            <div class="bg-slate-50 p-6 rounded-md border-l-4 border-emerald-500 text-slate-600 leading-relaxed font-medium">
                                                {{ $section['description'] ?? '' }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </article>
                </main>

                <aside class="lg:w-1/4">
                    <div class="sticky top-24">
                        <div class="bg-white rounded-md shadow-xl border border-emerald-100 overflow-hidden">
                            <div class="bg-[#217346] p-6">
                                <h3 class="text-white font-black uppercase text-xs tracking-[0.2em] leading-tight">
                                    {{ $categories[$article->category] ?? $article->category }}
                                </h3>
                            </div>

                            <div class="p-4 space-y-1">
                                @foreach($relatedArticles as $navItem)
                                    <a href="{{ route('articles.show', $navItem->slug) }}" 
                                       class="flex items-start gap-3 p-3 rounded-md transition-all duration-200 group {{ $article->id == $navItem->id ? 'bg-emerald-50 border border-emerald-100' : 'hover:bg-slate-50' }}">
                                        
                                        <span class="text-[10px] font-black {{ $article->id == $navItem->id ? 'text-emerald-600' : 'text-slate-300 group-hover:text-emerald-500' }} mt-0.5">
                                            {{ $loop->iteration }}.
                                        </span>

                                        <span class="text-[11px] font-bold {{ $article->id == $navItem->id ? 'text-slate-900' : 'text-slate-500 group-hover:text-slate-900' }} leading-snug">
                                            {{ $navItem->title }}
                                        </span>

                                        @if($article->id == $navItem->id)
                                            <div class="ml-auto w-1.5 h-1.5 rounded-full bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.6)]"></div>
                                        @endif
                                    </a>
                                @endforeach
                            </div>

                            <div class="p-6 bg-slate-50 border-t border-slate-100">
                                <a href="/blog?category={{ $article->category }}" class="text-[9px] font-black text-emerald-600 uppercase tracking-widest hover:text-slate-900 transition flex items-center justify-between">
                                    Tous les cours
                                    <span>→</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </aside>

            </div>
        </div>
    </div>
</x-layout>