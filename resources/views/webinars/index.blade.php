<x-layout>
    <div class="bg-slate-50 min-h-screen py-12" x-data="{ openModal: false, videoId: '' }">
        <div class="max-w-7xl mx-auto px-6">
            
            <h1 class="text-4xl font-black text-slate-900 mb-12 uppercase tracking-tighter">
                Webinaires & <span class="text-emerald-600">Replays</span>
            </h1>

            @if($upcomingWebinars->count() > 0)
            <div class="mb-20 relative" x-data="{ active: 0, count: {{ $upcomingWebinars->count() }} }">
                <div class="flex items-center gap-3 mb-6">
                    <span class="flex h-3 w-3 relative">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                    </span>
                    <h2 class="text-sm font-black uppercase tracking-widest text-slate-400">Prochains directs</h2>
                </div>

                <div class="relative px-4 md:px-12"> <template x-if="count > 1">
                        <button @click="active = active === 0 ? count - 1 : active - 1" 
                            class="absolute left-0 top-1/2 -translate-y-1/2 z-10 p-4 bg-white rounded-full shadow-xl text-slate-900 hover:bg-emerald-500 hover:text-white transition-all transform hover:scale-110 active:scale-95">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"/></svg>
                        </button>
                    </template>

                    <div class="relative overflow-hidden">
                        @foreach($upcomingWebinars as $index => $webinar)
                        <div x-show="active === {{ $index }}" 
                            x-transition:enter="transition duration-500" 
                            x-transition:enter-start="opacity-0 translate-x-12" 
                            class="bg-white rounded-md p-8 md:p-12 shadow-xl border border-emerald-100 flex flex-col md:flex-row gap-12 items-center">
                            
                            <div class="flex-1">
                                <span class="text-emerald-600 font-bold text-sm uppercase tracking-widest mb-4 block">
                                    {{ $webinar->scheduled_at->translatedFormat('d F Y \à H:i') }}
                                </span>
                                <h3 class="text-3xl md:text-5xl font-black text-slate-900 mb-6 leading-tight uppercase">{{ $webinar->title }}</h3>
                                
                                <a href="/inscription-webinaire/{{ $webinar->id }}" 
                                class="inline-flex items-center gap-3 bg-[#217346] text-white px-8 py-4 rounded-md font-black text-xs uppercase tracking-widest hover:bg-slate-900 transition shadow-lg">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                                    Réserver ma place
                                </a>
                            </div>

                            <div class="flex-1 w-full">
                                <div class="aspect-video rounded-sm overflow-hidden shadow-2xl">
                                    <img src="{{ $webinar->image_cover ? asset('storage/' . $webinar->image_cover) : 'https://img.youtube.com/vi/'.$webinar->youtube_id.'/maxresdefault.jpg' }}" class="w-full h-full object-cover">
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <template x-if="count > 1">
                        <button @click="active = active === count - 1 ? 0 : active + 1" 
                            class="absolute right-0 top-1/2 -translate-y-1/2 z-10 p-4 bg-white rounded-full shadow-xl text-slate-900 hover:bg-emerald-500 hover:text-white transition-all transform hover:scale-110 active:scale-95">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"/></svg>
                        </button>
                    </template>
                </div>
            </div>
            @endif

            <div>
                <div x-data="{ 
                    search: '',
                    replays: [
                        @foreach($pastWebinars as $past)
                        { id: '{{ $past->id }}', title: '{{ addslashes($past->title) }}', youtube_id: '{{ $past->youtube_id }}', date: '{{ $past->scheduled_at->format('d/m/Y') }}' },
                        @endforeach
                    ],
                    get filteredReplays() {
                        return this.replays.filter(i => i.title.toLowerCase().includes(this.search.toLowerCase()))
                    }
                }">
                    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
                        <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tight">Sessions précédentes</h2>
                        <div class="relative w-full md:w-80">
                            <input type="text" x-model="search" placeholder="Rechercher un titre..." 
                                class="w-full pl-12 pr-4 py-3 rounded-sm border-none bg-white shadow-sm focus:ring-2 focus:ring-emerald-500 font-medium text-sm">
                            <svg class="w-5 h-5 absolute left-4 top-3.5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <template x-for="replay in filteredReplays" :key="replay.id">
                            <div class="bg-white rounded-md border border-slate-100 overflow-hidden group hover:shadow-2xl transition-all">
                                <div class="relative aspect-video overflow-hidden cursor-pointer" @click="openModal = true; videoId = replay.youtube_id">
                                    <img :src="'https://img.youtube.com/vi/' + replay.youtube_id + '/mqdefault.jpg'" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                    <div class="absolute inset-0 bg-black/20 flex items-center justify-center">
                                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-xl"><svg class="w-5 h-5 text-emerald-600" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg></div>
                                    </div>
                                </div>
                                <div class="p-6">
                                    <h4 class="font-bold text-slate-900 mb-2 leading-tight" x-text="replay.title"></h4>
                                    <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest" x-text="'Replay du ' + replay.date"></p>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>

        <template x-if="openModal">
            <div class="fixed inset-0 z-[100] flex items-center justify-center bg-slate-900/90 backdrop-blur-md p-4"
                 @click.away="openModal = false; videoId = ''"
                 @keydown.escape.window="openModal = false; videoId = ''">
                
                <div class="relative w-full max-w-5xl aspect-video">
                    <button @click="openModal = false; videoId = ''" class="absolute -top-12 right-0 text-white hover:text-emerald-400 transition flex items-center gap-2 font-bold text-xs uppercase tracking-widest">
                        Fermer x
                    </button>
                    <iframe class="w-full h-full rounded-md shadow-2xl border border-white/10" 
                            :src="'https://www.youtube.com/embed/' + videoId + '?autoplay=1'" 
                            frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </template>

    </div>
</x-layout>