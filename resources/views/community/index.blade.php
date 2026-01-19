<x-layout>
    <main class="py-16 px-10 bg-slate-50 min-h-screen" x-data="{ search: '' }">
        <div class="max-w-7xl mx-auto">
            
            <div class="flex flex-col md:flex-row justify-between items-center mb-16 gap-8">
                <div>
                    <h1 class="text-5xl font-black text-slate-900 tracking-tighter uppercase">
                        LA <span class="text-emerald-500">COMMUNAUTÉ</span>
                    </h1>
                    <p class="text-slate-500 mt-2 font-medium">Entraide et partage d'expertise sur Excel & IT.</p>
                </div>

                <div class="flex items-center gap-4 w-full md:w-auto">
                    <div class="relative flex-grow">
                        <input type="text" x-model="search" placeholder="Rechercher un sujet..." 
                               class="pl-10 pr-4 py-3 bg-white border-none shadow-sm rounded-md focus:ring-2 focus:ring-emerald-500 w-full">
                        <svg class="w-5 h-5 text-slate-300 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>

                    <a href="{{ route('community.create') }}" class="bg-emerald-500 text-white px-6 py-3 rounded-md font-black text-[11px] uppercase tracking-widest hover:bg-slate-900 transition-all shadow-lg shadow-emerald-100 whitespace-nowrap">
                        + Poser une question
                    </a>
                </div>
            </div>

            <div class="space-y-4">
                @forelse($questions as $question)
                <div x-show="'{{ strtolower($question->title) }}'.includes(search.toLowerCase())"
                     class="bg-white p-8 rounded-md border border-slate-100 shadow-sm hover:shadow-md transition-all group">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <div class="flex-grow">
                            <div class="flex items-center gap-3 mb-3">
                                <span class="text-[10px] font-black px-3 py-1 rounded-full {{ $question->is_resolved ? 'bg-emerald-100 text-emerald-600' : 'bg-orange-100 text-orange-600' }} uppercase tracking-widest">
                                    {{ $question->is_resolved ? 'Résolu' : 'En attente' }}
                                </span>
                                <span class="text-slate-400 text-[11px] font-bold uppercase tracking-tight">{{ $question->category }}</span>
                            </div>
                            <h2 class="text-2xl font-black text-slate-800 group-hover:text-emerald-500 transition-colors tracking-tight">
                                <a href="{{ route('community.show', $question->slug) }}">{{ $question->title }}</a>
                            </h2>
                            <p class="text-slate-400 text-sm mt-2 font-medium">
                                Par <span class="text-slate-600 font-bold">{{ $question->user->name }}</span> • {{ $question->created_at->diffForHumans() }}
                            </p>
                        </div>
                        <div class="flex items-center gap-2 bg-slate-50 px-4 py-2 rounded-sm">
                            <span class="text-xl font-black text-slate-800">{{ $question->answers->count() }}</span>
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Réponses</span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-20 bg-white rounded-md border-2 border-dashed border-slate-100">
                    <p class="text-slate-400 font-bold italic text-lg">Aucune question pour le moment.</p>
                </div>
                @endforelse
            </div>

            <div class="mt-12">
                {{ $questions->links() }}
            </div>
        </div>
    </main>
</x-layout>