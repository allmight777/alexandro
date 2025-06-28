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
        Schema::table('equipements', function (Blueprint $table) {
            if (!Schema::hasColumn('equipements', 'quantite')) {
              $table->integer('quantite')->default(0);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('equipements', function (Blueprint $table) {
            if (Schema::hasColumn('equipements', 'quantite')) {
                $table->dropColumn('quantite');
            }   

        });
    }
};
