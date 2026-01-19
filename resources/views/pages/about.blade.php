<x-layout>
    <div class="bg-white overflow-x-hidden" x-data="{ 
        openModal: false, 
        activeMember: { name: '', role: '', bio: '', photo: '', fb: '', li: '', ig: '' },
        next() { this.$refs.slider.scrollBy({ left: this.$refs.slider.offsetWidth, behavior: 'smooth' }) },
        prev() { this.$refs.slider.scrollBy({ left: -this.$refs.slider.offsetWidth, behavior: 'smooth' }) }
    }">
        <div class="max-w-7xl mx-auto pt-16 px-6 text-center">
            <h1 class="text-5xl md:text-6xl font-black text-slate-900 tracking-tighter uppercase">
                L'Équipe <span class="text-emerald-500">ExcelAvance</span>
            </h1>
            <p class="text-slate-500 mt-4 font-medium uppercase tracking-[0.3em] text-[10px] italic">Expertise • Innovation • Accompagnement</p>
        </div>

        <section class="max-w-6xl mx-auto py-20 px-6">
            @php $chef = $team->first(); @endphp
            @if($chef)
            <div class="bg-slate-900 rounded-md overflow-hidden flex flex-col md:flex-row items-center shadow-2xl">
                <div class="md:w-1/2 relative group h-[500px] w-full">
                    <img src="{{ $chef->photo ? asset('storage/'.$chef->photo) : 'https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=800' }}" 
                         class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-transparent to-transparent"></div>
                    
                    <button @click="activeMember = { 
                        name: '{{ addslashes($chef->name) }}', 
                        role: '{{ addslashes($chef->role) }}', 
                        bio: `{!! str_replace(['\r', '\n'], ' ', addslashes($chef->bio)) !!}`,
                        photo: '{{ $chef->photo ? asset('storage/'.$chef->photo) : 'https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=800' }}',
                        fb: '{{ $chef->facebook }}', li: '{{ $chef->linkedin }}', ig: '{{ $chef->instagram }}'
                    }; openModal = true" 
                    class="absolute bottom-8 left-8 bg-emerald-500 text-white px-6 py-3 rounded-md font-bold text-xs tracking-widest hover:bg-white hover:text-slate-900 transition-all shadow-xl">
                        VOIR SON PARCOURS
                    </button>
                </div>
                
                <div class="md:w-1/2 p-12 lg:p-16 text-white">
                    <span class="text-emerald-400 font-black text-[10px] tracking-[0.4em] uppercase mb-4 block italic">Direction Générale</span>
                    <h2 class="text-4xl font-black mb-6 uppercase leading-tight">{{ $chef->name }}</h2>
                    <p class="text-slate-300 text-lg leading-relaxed mb-8 font-light italic">
                        "{{ Str::limit($chef->bio, 150) }}"
                    </p>
                    <div class="flex gap-4">
                        <div class="bg-slate-800/50 p-4 rounded-2xl border border-slate-700">
                            <span class="block text-2xl font-black text-emerald-400">500+</span>
                            <span class="text-[10px] text-slate-400 uppercase font-bold">Projets</span>
                        </div>
                        <div class="bg-slate-800/50 p-4 rounded-2xl border border-slate-700">
                            <span class="block text-2xl font-black text-emerald-400">12k</span>
                            <span class="text-[10px] text-slate-400 uppercase font-bold">Élèves</span>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </section>

        <section class="bg-slate-50 py-24 relative">
            <div class="max-w-7xl mx-auto px-6 mb-12">
                <h2 class="text-sm font-black text-emerald-600 uppercase tracking-[0.4em] mb-2">Nos Talents</h2>
                <h3 class="text-4xl font-black text-slate-900 tracking-tighter uppercase">Une équipe à votre service</h3>
            </div>

            <div class="max-w-[1400px] mx-auto px-12 relative group">
                <button @click="prev()" class="absolute left-2 top-1/2 -translate-y-1/2 z-20 w-12 h-12 rounded-full bg-white shadow-xl flex items-center justify-center hover:bg-emerald-500 hover:text-white transition-all transform hover:scale-110 active:scale-95">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>

                <div x-ref="slider" class="flex overflow-x-auto snap-x snap-mandatory no-scrollbar gap-6 pb-10">
                    @foreach($team->skip(1) as $member)
                    <div class="snap-start shrink-0 w-full sm:w-[calc(50%-12px)] lg:w-[calc(25%-18px)] group">
                        <div class="bg-white rounded-md p-4 shadow-sm border border-slate-100 group-hover:shadow-2xl transition-all duration-500">
                            <div class="relative h-80 rounded-sm overflow-hidden mb-6">
                                <img src="{{ $member->photo ? asset('storage/' . $member->photo) : 'https://i.pravatar.cc/400?u=' . $member->id }}" 
                                     class="w-full h-full object-cover transition duration-500">
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300 bg-emerald-900/20 backdrop-blur-sm">
                                    <button @click="activeMember = { 
                                        name: '{{ addslashes($member->name) }}', 
                                        role: '{{ addslashes($member->role) }}', 
                                        bio: `{!! str_replace(['\r', '\n'], ' ', addslashes($member->bio)) !!}`,
                                        photo: '{{ $member->photo ? asset('storage/' . $member->photo) : 'https://i.pravatar.cc/400?u=' . $member->id }}',
                                        fb: '{{ $member->facebook }}', li: '{{ $member->linkedin }}', ig: '{{ $member->instagram }}'
                                    }; openModal = true" 
                                    class="bg-white text-slate-900 px-6 py-2 rounded-full font-black text-[10px] tracking-widest shadow-xl transform hover:scale-105 transition">
                                        VOIR BIO
                                    </button>
                                </div>
                            </div>
                            <div class="text-center pb-4">
                                <h4 class="text-lg font-black text-slate-900 uppercase">{{ $member->name }}</h4>
                                <p class="text-emerald-600 text-[10px] font-bold uppercase tracking-widest mt-1">{{ $member->role }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <button @click="next()" class="absolute right-2 top-1/2 -translate-y-1/2 z-20 w-12 h-12 rounded-full bg-white shadow-xl flex items-center justify-center hover:bg-emerald-500 hover:text-white transition-all transform hover:scale-110 active:scale-95">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
            </div>
        </section>
<!--
        <div x-show="openModal" 
             class="fixed inset-0 z-[999] flex items-center justify-center p-4 md:p-6" style="display: none;">
            
            <div class="absolute inset-0 bg-slate-900/95 backdrop-blur-md" @click="openModal = false"></div>
            
            <div class="relative bg-white w-full max-w-4xl rounded-md overflow-hidden shadow-2xl flex flex-col md:flex-row" 
                 @click.away="openModal = false"
                 x-show="openModal"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="scale-90 opacity-0"
                 x-transition:enter-end="scale-100 opacity-100">
                
                <button @click="openModal = false" class="absolute top-6 right-6 z-30 w-10 h-10 bg-white shadow-lg rounded-full flex items-center justify-center hover:bg-emerald-500 hover:text-white transition">
                    <i class="fas fa-times"></i>
                </button>

                <div class="md:w-2/5 h-80 md:h-auto">
                    <img :src="activeMember.photo" class="w-full h-full object-cover">
                </div>
                
                <div class="md:w-3/5 p-10 md:p-16 flex flex-col justify-center">
                    <span class="text-emerald-500 font-black text-[10px] tracking-widest uppercase mb-2 block" x-text="activeMember.role"></span>
                    <h3 class="text-4xl font-black text-slate-900 mb-6 uppercase tracking-tighter" x-text="activeMember.name"></h3>
                    <p class="text-slate-600 text-lg leading-relaxed italic mb-8" x-text="activeMember.bio"></p>
                    
                    <div class="flex gap-4 mb-10">
                        <template x-if="activeMember.fb">
                            <a :href="activeMember.fb" target="_blank" class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center text-slate-600 hover:bg-blue-600 hover:text-white transition shadow-sm">
                                <i class="fab fa-facebook-f text-lg"></i>
                            </a>
                        </template>
                        <template x-if="activeMember.li">
                            <a :href="activeMember.li" target="_blank" class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center text-slate-600 hover:bg-blue-700 hover:text-white transition shadow-sm">
                                <i class="fab fa-linkedin-in text-lg"></i>
                            </a>
                        </template>
                        <template x-if="activeMember.ig">
                            <a :href="activeMember.ig" target="_blank" class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center text-slate-600 hover:bg-pink-600 hover:text-white transition shadow-sm">
                                <i class="fab fa-instagram text-lg"></i>
                            </a>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    -->

        <div x-show="openModal" 
    class="fixed inset-0 z-[999] flex items-center justify-center p-4 md:p-6" 
    x-transition:enter="transition opacity duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition opacity duration-300"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    style="display: none;">
    
    <div class="absolute inset-0 bg-slate-900/40" @click="openModal = false"></div>
    
    <div class="relative bg-white w-full max-w-4xl rounded-md overflow-hidden shadow-2xl flex flex-col md:flex-row max-h-[90vh]" 
        @click.away="openModal = false"
        x-show="openModal"
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="scale-90 opacity-0"
        x-transition:enter-end="scale-100 opacity-100">
        
        <button @click="openModal = false" class="absolute top-4 right-4 z-30 w-10 h-10 bg-white shadow-lg rounded-full flex items-center justify-center hover:bg-emerald-500 hover:text-white transition-all transform hover:rotate-90">
            <i class="fas fa-times"></i>
        </button>

        <div class="md:w-2/5 h-64 md:h-auto overflow-hidden">
            <img :src="activeMember.photo" class="w-full h-full object-cover">
        </div>
        
        <div class="md:w-3/5 p-8 md:p-12 flex flex-col overflow-y-auto max-h-[80vh] md:max-h-auto">
            <div class="my-auto"> <span class="text-emerald-500 font-black text-[10px] tracking-widest uppercase mb-2 block" x-text="activeMember.role"></span>
                <h3 class="text-3xl md:text-4xl font-black text-slate-900 mb-6 uppercase tracking-tighter" x-text="activeMember.name"></h3>
                
                <p class="text-slate-600 text-base md:text-lg leading-relaxed italic mb-8 whitespace-pre-line" x-text="activeMember.bio"></p>
                
                <div class="flex gap-4">
                    <template x-if="activeMember.fb">
                        <a :href="activeMember.fb" target="_blank" class="w-11 h-11 bg-slate-100 rounded-full flex items-center justify-center text-slate-600 hover:bg-emerald-500 hover:text-white transition shadow-sm">
                            <i class="fab fa-facebook-f text-lg"></i>
                        </a>
                    </template>
                    <template x-if="activeMember.li">
                        <a :href="activeMember.li" target="_blank" class="w-11 h-11 bg-slate-100 rounded-full flex items-center justify-center text-slate-600 hover:bg-emerald-500 hover:text-white transition shadow-sm">
                            <i class="fab fa-linkedin-in text-lg"></i>
                        </a>
                    </template>
                    <template x-if="activeMember.ig">
                        <a :href="activeMember.ig" target="_blank" class="w-11 h-11 bg-slate-100 rounded-full flex items-center justify-center text-slate-600 hover:bg-emerald-500 hover:text-white transition shadow-sm">
                            <i class="fab fa-instagram text-lg"></i>
                        </a>
                    </template>
                </div>
            </div>
        </div>
    </div>
</div>
        <section class="py-24 px-6">
            <div class="max-w-6xl mx-auto bg-slate-900 rounded-md p-12 md:p-24 text-center relative overflow-hidden shadow-2xl border border-white/10 group">
                <div class="absolute inset-0 z-0">
                    <img src="https://images.unsplash.com/photo-1543286386-713bdd548da4?q=80&w=2070" 
                         alt="Dashboard Analytics"
                         class="w-full h-full object-cover opacity-30 group-hover:scale-105 transition duration-[2s]">
                    <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-slate-900/80 to-emerald-900/50"></div>
                </div>

                <div class="relative z-10">
                    <h4 class="text-3xl md:text-5xl font-black text-white mb-6 leading-tight uppercase tracking-tighter">
                        Un besoin particulier en Excel ? <br><span class="text-emerald-400 italic">Parlons-en.</span>
                    </h4>
                    <p class="text-slate-300 mb-10 text-lg max-w-2xl mx-auto font-medium opacity-90">
                        Nos experts conçoivent des solutions sur mesure pour automatiser vos tâches et transformer vos données en décisions.
                    </p>
                    <a href="/contact" class="inline-block bg-emerald-500 text-white px-12 py-5 rounded-md font-black text-xs tracking-[0.2em] hover:bg-white hover:text-slate-900 transition-all transform hover:-translate-y-1 shadow-2xl uppercase">
                        Contactez-nous aujourd'hui
                    </a>
                </div>
            </div>
        </section>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        @media (min-width: 1024px) {
            #slider { scroll-padding: 0 24px; }
        }
    </style>
</x-layout>