<?php

use App\Enum\BullBreedEnum;
use App\Enum\BullOwnerEnum;
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
        Schema::create('breeding_bulls', function (Blueprint $table) {
            $table->id();
            $table->string('bull_name', 25)->unique();
            $table->enum('bull_owner', BullOwnerEnum::values());
            $table->enum('bull_breed', BullBreedEnum::values());
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('breeding_bulls');
    }
};
