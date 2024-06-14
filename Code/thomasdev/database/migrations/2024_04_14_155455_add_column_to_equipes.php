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
        Schema::table('equipes', function (Blueprint $table) {
            $table->date('delai')->nullable();
            $table->unsignedBigInteger('number_day')->nullable();
            $table->string('statut_delai')->default('En attente');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('equipes', function (Blueprint $table) {
            $table->dropColumn('delai');
            $table->dropColumn('number_day');
            $table->dropColumn('statut_delai');
        });
    }
};
