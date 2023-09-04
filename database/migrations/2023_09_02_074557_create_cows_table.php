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
        Schema::create('cows', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('ear_tag_no', 10)->unique();
            $table->string( 'name', 25)->unique();
            $table->string( 'gender', 10);
            $table->date('date_of_birth') -> nullable();
            $table->string('prev_owner_info', 30) -> nullable();
            $table->string('purchase_price', 10) -> nullable();
            $table->date('purchase_date') -> nullable();
            $table->string('mother_name', 25) -> nullable();
            $table->string('father_bull_no', 10) -> nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cows');
    }
};
