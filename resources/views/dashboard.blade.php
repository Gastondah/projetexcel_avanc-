<x-layout>
    <div class="max-w-7xl mx-auto py-12 px-6">
        
        <header class="mb-12">
            <h1 class="text-4xl font-black text-slate-900 tracking-tighter uppercase mb-8">
                MON ESPACE <span class="text-emerald-500">EXPERT</span>
            </h1>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-md shadow-sm border border-slate-100 flex items-center gap-5">
                    <div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-md flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Questions posées</p>
                        <p class="text-2xl font-black text-slate-900">{{ $myQuestions->count() }}</p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-md shadow-sm border border-slate-100 flex items-center gap-5">
                    <div class="w-14 h-14 bg-slate-900 text-white rounded-md flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Réponses données</p>
                        <p class="text-2xl font-black text-slate-900">{{ auth()->user()->answers()->count() }}</p>
                    </div>
                </div>

                <div class="bg-emerald-500 p-6 rounded-md shadow-lg shadow-emerald-100 flex items-center gap-5">
                    <div class="w-14 h-14 bg-white/20 text-white rounded-md flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-emerald-100 uppercase tracking-widest">Résolues</p>
                        <p class="text-2xl font-black text-white">{{ $myQuestions->where('is_resolved', true)->count() }}</p>
                    </div>
                </div>
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            <div class="bg-white p-10 rounded-md shadow-sm border border-slate-100 h-fit text-center">
                <div class="relative inline-block mb-6">
                    <div class="w-24 h-24 bg-slate-50 text-emerald-500 rounded-md flex items-center justify-center text-4xl font-black shadow-inner">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                    <div class="absolute -bottom-2 -right-2 bg-emerald-500 w-8 h-8 rounded-full border-4 border-white flex items-center justify-center">
                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    </div>
                </div>
                
                <h2 class="text-2xl font-black text-slate-900">{{ $user->name }}</h2>
                <p class="text-slate-400 font-medium text-sm mb-8">{{ $user->email }}</p>
                
                <a href="{{ route('profile.edit') }}" class="inline-block w-full py-4 bg-slate-50 text-slate-900 rounded-md text-[11px] font-black uppercase tracking-widest hover:bg-emerald-500 hover:text-white transition-all">
                    Paramètres du compte
                </a>
            </div>

            <div class="md:col-span-2">
                <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mb-8">Mes activités récentes</h3>

                <div class="space-y-4">
                    @forelse($myQuestions as $question)
                        <div class="bg-white p-6 rounded-md shadow-sm border border-slate-50 flex justify-between items-center group hover:border-emerald-200 transition-all">
                            <div class="flex items-center gap-6">
                                <div class="w-12 h-12 rounded-md flex items-center justify-center {{ $question->is_resolved ? 'bg-emerald-50 text-emerald-600' : 'bg-orange-50 text-orange-600' }}">
                                    @if($question->is_resolved)
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                    @else
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3"/></svg>
                                    @endif
                                </div>
                                <div>
                                    <h4 class="text-lg font-black text-slate-900 group-hover:text-emerald-600 transition">
                                        {{ $question->title }}
                                    </h4>
                                    <p class="text-xs font-bold text-slate-300 uppercase tracking-tighter">
                                        Posté {{ $question->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                <a href="{{ route('community.show', $question->slug) }}" 
                                class="w-10 h-10 bg-slate-50 rounded-xl flex items-center justify-center text-slate-400 hover:bg-emerald-500 hover:text-white transition-all shadow-sm"
                                title="Voir la discussion">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </a>

                                <form action="{{ route('community.destroy', $question->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette question ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="w-10 h-10 bg-red-50 rounded-xl flex items-center justify-center text-red-400 hover:bg-red-500 hover:text-white transition-all shadow-sm"
                                            title="Supprimer définitivement">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                        @empty
                        <div class="bg-slate-50 p-12 rounded-md border-2 border-dashed border-slate-200 text-center">
                            <p class="text-slate-400 font-bold mb-4">Aucune activité enregistrée.</p>
                            <a href="{{ route('community.create') }}" class="text-emerald-600 font-black uppercase text-xs tracking-widest hover:underline">Poser une question →</a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-layout>