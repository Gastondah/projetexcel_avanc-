<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('software', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category')->nullable(); // Ajout catégorie
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->string('video_demo_id'); // ID YouTube (ex: dQw4w9WgXcQ)
            $table->json('screenshots')->nullable(); // Ajout captures d'écran
            $table->string('file_path'); // Chemin du fichier .xlsx sécurisé
            $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('software');
    }
};
