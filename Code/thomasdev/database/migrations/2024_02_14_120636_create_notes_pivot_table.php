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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('note');
            $table->char('mention',50);
            $table->string('remarque');
            $table->unsignedBigInteger('resultat_id');
            $table->unsignedBigInteger('membre_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
