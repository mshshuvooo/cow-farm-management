<?php

use App\Enum\CowGenderEnum;
use App\Enum\CowStatusEnum;
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
            $table->enum('gender', CowGenderEnum::values());
            $table->enum('status', CowStatusEnum::values());
            $table->date('date_of_birth') -> nullable();
            $table->string('extra_info', 500) -> nullable();
            $table->bigInteger('purchase_price') -> nullable();
            $table->date('purchase_date') -> nullable();
            $table->string('mother_id') -> nullable();
            $table->string('father_id') -> nullable();
            $table->softDeletes();
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
