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
        Schema::create('cow_vaccine', function (Blueprint $table) {
            $table->foreignId('cow_id')->constrained('cows')->onDelete('cascade');
            $table->foreignId('vaccine_id')->constrained('vaccines')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('cow_vaccine', function(Blueprint $table) {
        //     $table->dropForeign(['cow_id']);
        //     $table->dropForeign(['vaccine_id']);
        //     $table->dropIfExists();
        // });

        Schema::dropIfExists('cow_vaccine');
    }
};
