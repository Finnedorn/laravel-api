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
        Schema::create('project_technology', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            // la funzione cascadeondelete() implica che una volta eliminato l'id utente, tutti gli elementi
            // in realzione con questo vengano eliminati di conseguenza
            // in questo caso voglio che una volta eliminato l'id del progetto, mi vengano pure eliminato
            // il collegamento a ponte con tutte le altre tecnologie relative a quel progetto
            $table->foreign('project_id')->references('id')->on('projects')->cascadeOnDelete();

            $table->unsignedBigInteger('technology_id');
            $table->foreign('technology_id')->references('id')->on('technologies')->cascadeOnDelete();
            // per convenzione, in una tabella ponte per la primary key si usano gli id di entrambe le tabelle:
            // $table->primary(['project_id', 'technology_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_technology');
    }
};
