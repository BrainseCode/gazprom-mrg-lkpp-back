<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('calorie_archives', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->double('caloric');
            $table->string('quality_passport');
            $table->unsignedBigInteger('contract_id');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calorie_archives');
    }
};
