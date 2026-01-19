<x-layout>
    <main class="min-h-screen bg-slate-50 flex items-center justify-center px-6 py-12">
        <div class="w-full max-w-md">
            
            <div class="bg-white rounded-md p-12 shadow-2xl shadow-slate-200 border border-slate-100">
                <header class="text-center mb-10">
                    <h1 class="text-4xl font-black text-slate-900 tracking-tighter uppercase">
                        ESPACE <span class="text-emerald-500">EXPERT</span>
                    </h1>
                    <p class="text-slate-400 mt-2 font-medium">Connectez-vous pour interagir</p>
                </header>

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-4">Email</label>
                        <input type="email" name="email" required autofocus
                               class="w-full px-6 py-4 bg-slate-50 border-none rounded-md focus:ring-2 focus:ring-emerald-500 font-bold text-slate-700 transition-all shadow-inner"
                               placeholder="expert@excel.com">
                        @error('email') <span class="text-red-500 text-xs mt-1 ml-4">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-4">Mot de passe</label>
                        <input type="password" name="password" required
                               class="w-full px-6 py-4 bg-slate-50 border-none rounded-md focus:ring-2 focus:ring-emerald-500 font-bold text-slate-700 transition-all shadow-inner"
                               placeholder="••••••••">
                    </div>

                    <button type="submit" 
                            class="w-full bg-slate-900 text-white py-5 rounded-md font-black text-[12px] uppercase tracking-[0.2em] hover:bg-emerald-600 transition-all duration-300 shadow-xl shadow-slate-200">
                        Se connecter
                    </button>
                </form>

                <footer class="mt-8 text-center">
                    <p class="text-slate-400 text-sm">Pas encore membre ? 
                        <a href="{{ route('register') }}" class="text-emerald-600 font-black hover:underline">S'inscrire</a>
                    </p>
                </footer>
            </div>

        </div>
    </main>
</x-layout>