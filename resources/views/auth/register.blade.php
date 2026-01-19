<x-layout>
    <main class="min-h-screen bg-slate-50 flex items-center justify-center px-6 py-12">
        <div class="w-full max-w-md">
            
            <div class="bg-white rounded-md p-12 shadow-2xl shadow-slate-200 border border-slate-100">
                <header class="text-center mb-10">
                    <h1 class="text-4xl font-black text-slate-900 tracking-tighter uppercase">
                        REJOINDRE <span class="text-emerald-500">L'ÉQUIPE</span>
                    </h1>
                    <p class="text-slate-400 mt-2 font-medium">Créez votre compte expert gratuitement</p>
                </header>

                <form method="POST" action="{{ route('register') }}" class="space-y-5" x-data="{ show: false, showConfirm: false }">
                    @csrf

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-4">Nom Complet</label>
                        <input type="text" name="name" :value="old('name')" required autofocus
                               class="w-full px-6 py-4 bg-slate-50 border-none rounded-md focus:ring-2 focus:ring-emerald-500 font-bold text-slate-700 transition-all shadow-inner"
                               placeholder="John Doe">
                        @error('name') <span class="text-red-500 text-[10px] mt-1 ml-4 font-bold">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-4">Email Professionnel</label>
                        <input type="email" name="email" :value="old('email')" required
                               class="w-full px-6 py-4 bg-slate-50 border-none rounded-md focus:ring-2 focus:ring-emerald-500 font-bold text-slate-700 transition-all shadow-inner"
                               placeholder="expert@excel.com">
                        @error('email') <span class="text-red-500 text-[10px] mt-1 ml-4 font-bold">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-4">Mot de passe</label>
                        <div class="relative">
                            <input :type="show ? 'text' : 'password'" name="password" required
                                   class="w-full px-6 py-4 bg-slate-50 border-none rounded-md focus:ring-2 focus:ring-emerald-500 font-bold text-slate-700 transition-all shadow-inner"
                                   placeholder="••••••••">
                            <button type="button" @click="show = !show" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-300 hover:text-emerald-500 transition-colors">
                                <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.05 10.05 0 014.13-5.033m4.846-1.724A9.555 9.555 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.032m-4.322-4.322a3 3 0 11-4.243-4.243M3 3l18 18"/></svg>
                            </button>
                        </div>
                        @error('password') <span class="text-red-500 text-[10px] mt-1 ml-4 font-bold">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-4">Confirmer</label>
                        <div class="relative">
                            <input :type="showConfirm ? 'text' : 'password'" name="password_confirmation" required
                                   class="w-full px-6 py-4 bg-slate-50 border-none rounded-md focus:ring-2 focus:ring-emerald-500 font-bold text-slate-700 transition-all shadow-inner"
                                   placeholder="••••••••">
                            <button type="button" @click="showConfirm = !showConfirm" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-300 hover:text-emerald-500 transition-colors">
                                <svg x-show="!showConfirm" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                <svg x-show="showConfirm" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.05 10.05 0 014.13-5.033m4.846-1.724A9.555 9.555 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.032m-4.322-4.322a3 3 0 11-4.243-4.243M3 3l18 18"/></svg>
                            </button>
                        </div>
                    </div>

                    <button type="submit" 
                            class="w-full bg-slate-900 text-white py-5 rounded-md font-black text-[12px] uppercase tracking-[0.2em] hover:bg-emerald-600 transition-all duration-300 shadow-xl shadow-slate-200 mt-4">
                        Créer mon compte
                    </button>
                </form>

                <footer class="mt-8 text-center">
                    <p class="text-slate-400 text-sm font-medium">Déjà inscrit ? 
                        <a href="{{ route('login') }}" class="text-emerald-600 font-black hover:underline">Se connecter</a>
                    </p>
                </footer>
            </div>

        </div>
    </main>
</x-layout>