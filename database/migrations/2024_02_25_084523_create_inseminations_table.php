<?php

use App\Enum\InseminationTypeEnum;
use App\Enum\TypeOfSemenEnum;
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
        Schema::create('inseminations', function (Blueprint $table) {
            $table->id();
            $table->string('cow_id');
            $table->dateTime('insemination_time');
            $table->string('bull_id');
            $table->enum('insemination_type', InseminationTypeEnum::values());
            $table->enum('type_of_semen', TypeOfSemenEnum::values());
            $table->string('reproduction_number');
            $table->date('possible_delivery_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inseminations');
    }
};
