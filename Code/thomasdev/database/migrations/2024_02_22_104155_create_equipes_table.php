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
        Schema::create('equipes', function (Blueprint $table) {
            $table->id();
            $table->string('nom_equipe')->unique();
            $table->unsignedBigInteger('effectif');
            $table->unsignedBigInteger('effectif_min')->default(0);
            $table->string('document_equipe');
            $table->string('email_equipe')->unique();
            $table->string('statut_equipe')->default('inactif');
            $table->unsignedBigInteger('type_equipe_id');
            $table->foreign('type_equipe_id')->references('id')->on('type_equipes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipes');
    }
};
