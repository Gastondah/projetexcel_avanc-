<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('software', function (Blueprint $table) {
            // On ajoute les colonnes manquantes
            if (!Schema::hasColumn('software', 'category')) {
                $table->string('category')->nullable()->after('name');
            }
            if (!Schema::hasColumn('software', 'screenshots')) {
                $table->json('screenshots')->nullable()->after('video_demo_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('software', function (Blueprint $table) {
            $table->dropColumn(['category', 'screenshots']);
        });
    }
};