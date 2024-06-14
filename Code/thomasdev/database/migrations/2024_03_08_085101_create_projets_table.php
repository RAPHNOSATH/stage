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
        Schema::disableForeignKeyConstraints();
        Schema::create('projets', function (Blueprint $table) {
            $table->id();
            $table->char('intitule_projet');
            $table->char('description_projet');
            $table->char('document_descriptif')->nullable();
            $table->boolean('en_recherche')->default('false');
            $table->boolean('est_accepte')->default('false');
            $table->unsignedBigInteger('sous_domaine_id');
            $table->foreign('sous_domaine_id')->references('id')->on('sous_domaines');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('equipe_id')->nullable();
            $table->foreign('equipe_id')->references('id')->on('equipes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projets');
    }
};
