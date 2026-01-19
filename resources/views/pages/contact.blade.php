<x-layout>
    <div class="max-w-4xl mx-auto py-16 px-6">
        <h1 class="text-3xl font-extrabold text-gray-900 text-center mb-8">Contactez l'expert Excel</h1>
        
        <div class="bg-white shadow-xl rounded-2xl overflow-hidden grid md:grid-cols-5">
            <div class="md:col-span-2 bg-emerald-500 p-10 text-white">
                <h3 class="text-xl font-bold mb-6">Nos coordonnées</h3>
                <p class="mb-4">📧 contact@excelavance.com</p>
                <p class="mb-4">📍 Dakar, Sénégal</p>
                <div class="mt-10 p-4 bg-emerald-600 rounded-lg text-sm italic">
                    "Nous répondons généralement en moins de 24h pour toute demande de formation ou d'expertise."
                </div>
            </div>

            <form action="{{ route('contact.send') }}" method="POST" class="md:col-span-3 p-10 space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nom complet</label>
                    <input type="text" name="name" class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Votre besoin</label>
                    <textarea name="message" rows="4" class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500"></textarea>
                </div>
                <button type="submit" class="w-full bg-emerald-500 text-white font-bold py-3 rounded-md hover:bg-emerald-600 transition">
                    Envoyer le message
                </button>
            </form>
        </div>
    </div>
</x-layout>