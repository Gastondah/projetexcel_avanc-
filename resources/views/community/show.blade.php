<x-layout>
    <main class="py-16 px-10 bg-slate-50 min-h-screen">
        <div class="max-w-4xl mx-auto">
            
            <div class="flex justify-between items-center mb-8">
                <a href="{{ route('community.index') }}" class="text-slate-400 hover:text-emerald-600 font-black text-[10px] uppercase tracking-[0.2em] flex items-center gap-2 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Retour à la liste
                </a>
                <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest {{ $question->is_resolved ? 'bg-emerald-100 text-emerald-600' : 'bg-orange-100 text-orange-600' }}">
                    {{ $question->is_resolved ? '✓ Résolu' : '• En attente' }}
                </span>
            </div>

            <article class="bg-white rounded-md p-10 shadow-sm border border-slate-100 mb-12">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 bg-emerald-500 rounded-sm flex items-center justify-center text-white font-black">
                        {{ substr($question->user->name, 0, 1) }}
                    </div>
                    <div>
                        <p class="text-slate-900 font-black text-sm">{{ $question->user->name }}</p>
                        <p class="text-slate-400 text-xs font-medium uppercase tracking-tighter">{{ $question->created_at->diffForHumans() }}</p>
                    </div>
                </div>

                <h1 class="text-4xl font-black text-slate-900 tracking-tight mb-6 leading-tight">
                    {{ $question->title }}
                </h1>

                <div class="text-slate-600 leading-relaxed text-lg whitespace-pre-line border-l-4 border-slate-50 pl-6 italic">
                    "{{ $question->content }}"
                </div>

                @if(auth()->id() === $question->user_id && !$question->is_resolved)
                    <form action="{{ route('community.resolve', $question->id) }}" method="POST" class="mt-10">
                        @csrf @method('PATCH')
                        <button class="bg-emerald-500 text-white px-8 py-3 rounded-xl font-black text-[11px] uppercase tracking-widest hover:bg-slate-900 transition-all shadow-lg shadow-emerald-100">
                            Marquer comme résolu
                        </button>
                    </form>
                @endif
            </article>

            <div class="space-y-6">
                <h3 class="text-slate-400 font-black text-[10px] uppercase tracking-[0.3em] mb-8">
                    {{ $question->answers->count() }} Réponses apportées
                </h3>

                @foreach($question->answers as $answer)
                    <div class="bg-white p-8 rounded-md border border-slate-100 shadow-sm relative overflow-hidden">
                        @if($loop->first && $question->is_resolved)
                            <div class="absolute top-0 right-0 bg-emerald-500 text-white px-4 py-1 text-[9px] font-black uppercase tracking-widest">Meilleure réponse</div>
                        @endif

                        <div class="flex justify-between items-center mb-4">
                            <span class="text-slate-900 font-black text-sm">{{ $answer->user->name }}</span>
                            <span class="text-slate-300 text-[10px] font-bold">{{ $answer->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-slate-600 leading-relaxed">{{ $answer->content }}</p>
                    </div>
                @endforeach
            </div>

            @auth
                <div class="mt-12 pt-12 border-t border-slate-200">
                    <form action="{{ route('community.answer.store', $question->id) }}" method="POST">
                        @csrf
                        <textarea name="content" rows="5" class="w-full border-none bg-white shadow-inner rounded-md p-8 focus:ring-2 focus:ring-emerald-500 mb-6 font-medium text-slate-600" placeholder="Votre expertise ici..."></textarea>
                        <button type="submit" class="bg-slate-900 text-white px-10 py-4 rounded-md font-black text-[11px] uppercase tracking-widest hover:bg-emerald-500 transition-all shadow-xl">
                            Publier ma réponse
                        </button>
                    </form>
                </div>
            @else
                <div class="mt-12 p-8 bg-slate-900 rounded-md text-center">
                    <p class="text-slate-400 font-bold mb-4">Vous avez la solution ? Connectez-vous pour aider.</p>
                    <a href="{{ route('login') }}" class="text-emerald-400 font-black uppercase tracking-widest text-xs hover:text-white transition-colors underline">Connexion →</a>
                </div>
            @endauth

        </div>
    </main>
</x-layout>