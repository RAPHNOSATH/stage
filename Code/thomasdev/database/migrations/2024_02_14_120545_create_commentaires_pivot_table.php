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
        Schema::create('commentaires', function (Blueprint $table) {
            $table->id();
            $table->string('commentaire');
            $table->unsignedBigInteger('nombre_c');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('projet_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commentaires');
    }
};
