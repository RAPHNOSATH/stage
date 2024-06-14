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
        Schema::table('resultats', function (Blueprint $table) {
            $table->unsignedBigInteger('etat')->default(0);
            $table->boolean('is_resultat_valid')->default(false);
            $table->boolean('is_business_valid')->default(false);
            $table->boolean('is_document_valid')->default(false);
            $table->boolean('is_visite_terrain_valid')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('resultats', function (Blueprint $table) {
            $table->dropColumn('etat');
            $table->dropColumn('is_resultat_valid');
            $table->dropColumn('is_business_valid');
            $table->dropColumn('is_document_valid');
            $table->dropColumn('is_visite_terrain_valid');
        });
    }
};
