<x-layout>
    <section class="bg-[#f0f9f4] py-16 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-16 items-center">
            <div>
                <h1 class="text-6xl md:text-[80px] font-black text-slate-900 leading-[0.95] tracking-tighter mb-8">
                    Apprenez Excel <br><span class="text-[#217346]">gratuitement.</span>
                </h1>
                <p class="text-xl text-slate-600 leading-relaxed mb-10 max-w-md font-medium">
                    Découvrez nos derniers articles techniques et progressez grâce aux retours de notre communauté d'experts.
                </p>
                <a href="/blog" class="inline-block bg-[#217346] text-white px-10 py-4 rounded-md font-bold text-sm tracking-widest shadow-lg hover:bg-slate-900 transition-all hover:-translate-y-1">
                    LIRE NOS ARTICLES
                </a>
            </div>

            <div class="relative overflow-hidden rounded-md shadow-2xl bg-white aspect-video border-8 border-white" id="hero-slider">
                <div class="flex transition-transform duration-700 ease-in-out h-full" id="hero-track">
                    <div class="min-w-full relative h-full">
                        <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=1200" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/30 flex flex-col justify-end p-10">
                            <h3 class="text-white text-3xl font-black mb-4 uppercase">Webinaire : Dashboard 2026</h3>
                            <a href="/webinaires" class="bg-[#217346] text-white px-6 py-3 rounded-md text-xs font-black tracking-widest w-fit hover:bg-white hover:text-[#217346] transition">S'INSCRIRE</a>
                        </div>
                    </div>
                    <div class="min-w-full relative h-full">
                        <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=2000" class="rounded-sm shadow-2xl border-8 border-white">
                        <div class="absolute inset-0 bg-[#217346]/40 flex flex-col justify-end p-10">
                            <h3 class="text-white text-3xl font-black mb-4 uppercase">Rejoignez le Forum</h3>
                            <a href="/communaute" class="bg-white text-[#217346] px-6 py-3 rounded-md text-xs font-black tracking-widest w-fit hover:bg-slate-900 hover:text-white transition">PARTICIPER</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-12">
                <h2 class="text-sm font-black text-[#217346] uppercase tracking-[0.4em] mb-2">Événements en direct</h2>
                <h3 class="text-4xl font-black tracking-tighter text-slate-900">Nos Webinaires</h3>
            </div>

            <div class="grid md:grid-cols-2 gap-10">
                <div class="bg-[#f0f9f4] p-12 rounded-md border border-green-100 flex flex-col justify-between group">
                    <div>
                        <span class="text-[10px] font-black bg-[#217346] text-white px-4 py-1.5 rounded-full mb-8 inline-block uppercase tracking-widest">Bientôt</span>
                        <h4 class="text-4xl font-black text-slate-900 mb-6 uppercase leading-tight">{{ $nextWebinar->title ?? 'À venir' }} <br>VBA Avancé</h4>
                        <p class="text-slate-600 mb-10 font-medium text-lg italic">Posez vos questions en direct et recevez les supports de cours gratuitement.</p>
                    </div>
                    <a href="/webinaires" class="bg-slate-900 text-white px-10 py-4 rounded-md font-black text-xs w-fit hover:bg-[#217346] transition-colors">RÉSERVER MA PLACE</a>
                </div>

            @if($latestReplay)
            <div class="relative overflow-hidden bg-slate-900 rounded-md p-12 group">
                <img src="https://img.youtube.com/vi/{{ $latestReplay->youtube_id }}/maxresdefault.jpg" class="absolute inset-0 w-full h-full object-cover opacity-10 group-hover:scale-110 transition duration-1000">
                
                <div class="relative z-10 flex flex-col h-full">
                    <span class="text-emerald-400 font-black text-[10px] tracking-[0.3em] mb-8 uppercase italic">Dernier Replay Disponible</span>
                    <h3 class="text-4xl font-[900] text-white mb-6 leading-tight uppercase">{{ $latestReplay->title }}.</h3>
                    <a href="/webinaires/replay" class="mt-auto flex items-center gap-4 group/btn">
                        <div class="w-14 h-14 bg-emerald-500 rounded-full flex items-center justify-center group-hover/btn:bg-white transition-all">
                            <svg class="w-6 h-6 text-white group-hover/btn:text-[#062c1b]" fill="currentColor" viewBox="0 0 20 20"><path d="M6.3 2.841A1.5 1.5 0 004 4.11v11.78a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.841z"></path></svg>
                        </div>
                        <span class="text-white font-black text-xs tracking-widest">VOIR L'ENREGISTREMENT</span>
                    </a>
                </div>
            </div>
            @else
            <div class="bg-slate-100 rounded-md p-12 flex items-center justify-center border-2 border-dashed border-slate-200">
                <p class="text-slate-400 font-bold uppercase tracking-widest text-xs">Aucun replay disponible pour le moment</p>
            </div>
            @endif
        </div>
    </section>


    <section class="py-20 bg-[#f0f9f4]">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-16">
                <h2 class="text-sm font-black text-[#217346] uppercase tracking-[0.4em] mb-2">Les dernières publications</h2>
                <h3 class="text-4xl font-black tracking-tighter text-slate-900">Nos Articles</h3>
            </div>

            <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-8">
                @foreach($latestArticles->take(3) as $article)
                <div class="bg-white p-6 rounded-md shadow-sm border border-green-50 group hover:shadow-2xl transition-all duration-500 flex flex-col h-full">
                    <div class="h-60 overflow-hidden rounded-sm mb-8">
                        <img src="{{ asset('storage/' . $article->image_cover) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    </div>
                    
                    <h4 class="text-2xl font-bold text-slate-800 mb-6 leading-tight group-hover:text-[#217346] transition flex-grow">
                        {{ $article->title }}
                    </h4>
                    
                    <div class="flex items-center justify-between pt-6 border-t border-slate-50 mt-auto">
                        <span class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">
                            {{ $article->created_at->format('d/m/Y') }}
                        </span>
                        
                        <a href="{{ route('articles.show', $article->slug) }}" class="flex items-center gap-2 bg-[#f0f9f4] text-[#217346] px-5 py-2.5 rounded-sm font-black text-[10px] tracking-widest uppercase transition-all duration-300 hover:bg-[#217346] hover:text-white group/btn">
                            Lire l'article
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 transition-transform group-hover/btn:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <script>
        // Script pour le slider du Hero
        const track = document.getElementById('hero-track');
        let index = 0;
        setInterval(() => {
            index = (index + 1) % 2;
            track.style.transform = `translateX(-${index * 100}%)`;
        }, 5000);
    </script>
</x-layout>