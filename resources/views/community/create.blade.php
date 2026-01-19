<x-layout>
    <div class="max-w-3xl mx-auto py-12 px-6">
        <h1 class="text-3xl font-bold mb-8">Poser une question à la communauté</h1>

        <form action="{{ route('community.store') }}" method="POST" class="bg-white p-8 rounded-md shadow-lg">
            @csrf
            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Titre de votre problème</label>
                <input type="text" name="title" placeholder="Ex: Comment faire une rechercheV sur deux colonnes ?" 
                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring-green-500" required>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Description détaillée</label>
                <textarea name="content" rows="6" placeholder="Expliquez votre problème ici..."
                          class="w-full border-gray-300 rounded-sm shadow-sm focus:border-green-500 focus:ring-green-500" required></textarea>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('community.index') }}" class="px-6 py-2 text-gray-600 hover:underline">Annuler</a>
                <button type="submit" class="bg-green-600 text-white px-8 py-2 rounded-md font-bold hover:bg-green-700">
                    Publier ma question
                </button>
            </div>
        </form>
    </div>
</x-layout>