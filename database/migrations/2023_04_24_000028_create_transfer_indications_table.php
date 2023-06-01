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
        Schema::create('transfer_indications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('measuring_complex_id');
            $table->date('date');
            $table->double('indication');
            $table->double('value');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfer_indications');
    }
};
