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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->string('pays')->default('Burkina Faso');
            $table->string('intitule')->nullable();
            $table->string('description')->nullable();
            $table->string('domaine')->nullable();
            $table->string('specialite')->nullable();
            $table->string('titre_academique')->nullable();
            $table->string('service')->nullable();
            $table->string('matricule')->unique()->nullable();
            $table->string('filiere')->nullable();
            $table->string('niveau')->nullable();
            $table->string('option')->nullable();
            $table->string('universite')->nullable();
            $table->string('adresse')->nullable();
            $table->string('email')->unique();
            $table->string('telephone')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('is_active')->default('true');
            $table->boolean('is_staff')->default('false');
            $table->boolean('is_superuser')->default('false');
            $table->string('document')->nullable();
            $table->string('cv')->nullable();
            $table->string('contrat')->nullable();
            $table->string('image')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
