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
        Schema::table('users', function (Blueprint $table) {
            $table->string('carte_grise')->nullable();
            $table->string('num_permis')->nullable();
            $table->date('date_emission_permis')->nullable();
            $table->date('date_expiration_permis')->nullable();
            $table->binary('photo_permis')->nullable();
            $table->string('num_identite')->nullable();
            $table->date('date_emission_identite')->nullable();
            $table->date('date_expiration_identite')->nullable();
            $table->binary('photo_identite')->nullable();
            $table->string('annee_experience_conducteur')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
