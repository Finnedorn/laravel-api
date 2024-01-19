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
        Schema::table('projects', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('category_id')->nullable()->after('user_id');
            $table->foreign('category_id')
                ->references('id')
                // la funzione nullOnDelete() mi permette una volta eliminato l'id
                // di settare tutte le categorie in relazione con quell'id a null
                // ovviamente voglio settarle a null in quanto non voglio che le categorie
                // essendo in relazione molte ad uno con project
                // mi vengano eliminate altrimenti eliminerei pure le categorie in relazione con altri id
                ->on('categories')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            //
            $table->dropForeign('projects_category_id_foreign');
            $table->dropColumn('category_id');
        });
    }
};
