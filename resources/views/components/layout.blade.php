<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExcelAvance — Communauté & Expertise</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-white text-slate-900 antialiased">

<header class="bg-emerald-500 sticky top-0 z-50 shadow-lg">
    <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
        <a href="/" class="flex items-center gap-3">
            <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center shadow-sm">
                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
            <span class="text-xl font-black tracking-tighter uppercase italic text-white">Excel<span>Avance</span></span>
        </a>

        <nav class="hidden lg:flex items-center gap-8">
            @php $route = Request::path(); @endphp
            <a href="/" class="text-[11px] font-bold tracking-widest {{ $route == '/' ? 'text-white border-b-2 border-white' : 'text-emerald-50 hover:text-white' }}">ACCUEIL</a>
            
            <a href="/blog" class="text-[11px] font-bold tracking-widest {{ str_contains($route, 'blog') ? 'text-white border-b-2 border-white' : 'text-emerald-50 hover:text-white' }}">BLOGS</a>
            <a href="/webinaires" class="text-[11px] font-bold tracking-widest {{ str_contains($route, 'webinaires') ? 'text-white border-b-2 border-white' : 'text-emerald-50 hover:text-white' }}">WEBINAIRES</a>
            <a href="/a-propos" class="text-[11px] font-bold tracking-widest {{ str_contains($route, 'a-propos') ? 'text-white border-b-2 border-white' : 'text-emerald-50 hover:text-white' }}">À PROPOS</a>
            <a href="/logiciels" class="text-[11px] font-bold tracking-widest {{ str_contains($route, 'logiciels') ? 'text-white border-b-2 border-white' : 'text-emerald-50 hover:text-white' }}">LOGICIELS</a>
            <a href="/communaute" class="text-[11px] font-bold tracking-widest {{ str_contains($route, 'communaute') ? 'text-white border-b-2 border-white' : 'text-emerald-50 hover:text-white' }}">COMMUNAUTÉ</a>
        </nav>
        
        <div class="flex items-center gap-6">
            @guest
                <a href="/login" class="text-[11px] font-bold text-white uppercase hover:underline">Connexion</a>
                <a href="/register" class="bg-slate-900 text-white px-6 py-2.5 rounded-md text-[11px] font-bold uppercase shadow-md hover:bg-white hover:text-emerald-600 transition">S'inscrire</a>
            @endguest
            @auth
                <div class="flex items-center gap-4">
                    <div class="hidden md:block text-right">
                        <p class="text-[9px] font-black text-emerald-100 uppercase tracking-widest">Connecté en tant que</p>
                        <p class="text-[11px] font-bold text-white">{{ auth()->user()->name }}</p>
                    </div>
                    <a href="{{ route('dashboard') }}" 
                    class="w-10 h-10 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center font-black text-sm shadow-inner hover:bg-slate-900 hover:text-white transition-all duration-300 transform hover:rotate-3 group"
                    title="Aller au tableau de bord">
                        {{ substr(auth()->user()->name, 0, 1) }}
                        <span class="absolute -top-1 -right-1 w-3 h-3  border-emerald-500 rounded-full"></span>
                    </a>
                                        
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-white text-emerald-600 px-5 py-2.5 rounded-md text-[11px] font-black uppercase shadow-md hover:bg-slate-900 hover:text-white transition transform hover:scale-105 active:scale-95">
                            Déconnexion
                        </button>
                    </form>
                </div>
            @endauth
        </div>
    </div>
</header>

<main>
    {{ $slot }}
</main>

<footer class="bg-emerald-500 text-white pt-20 pb-10">
    <div class="max-w-7xl mx-auto px-8">
        <div class="grid md:grid-cols-3 gap-16 border-b border-emerald-400 pb-16">
            <div>
                <span class="text-xl font-black uppercase tracking-tighter italic">ExcelAvance</span>
                <p class="mt-6 text-emerald-50 text-sm leading-relaxed">Une plateforme dédiée au partage d'astuces Excel et à l'entraide communautaire pour automatiser vos tâches quotidiennes.</p>
            </div>
            <div>
                <h4 class="font-bold text-sm uppercase tracking-widest text-slate-900 mb-6">Mentions Légales</h4>
                <ul class="space-y-4 text-emerald-50 text-sm font-semibold">
                    <li><a href="/conditions" class="hover:text-slate-900 transition">Conditions d'Utilisation</a></li>
                    <li><a href="/confidentialite" class="hover:text-slate-900 transition">Politique de Confidentialité</a></li>
                    <li><a href="/cookies" class="hover:text-slate-900 transition">Gestion des Cookies</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-sm uppercase tracking-widest text-slate-900 mb-6">Communauté</h4>
                <p class="text-emerald-50 text-sm">Besoin d'aide ? Posez votre question sur notre forum d'entraide ou contactez-nous.</p>
                <a href="mailto:contact@excelavance.com" class="text-white font-black block mt-4 text-lg">contact@excelavance.com</a>
            </div>
        </div>
        <p class="mt-10 text-center text-[10px] text-emerald-100 font-bold uppercase tracking-[0.4em]">© 2026 EXCELAVANCE — PARTAGE & EXPERTISE — RÉPUBLIQUE DU BÉNIN</p>
    </div>
</footer>

</body>
</html>