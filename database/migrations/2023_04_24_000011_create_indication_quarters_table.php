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
        Schema::create('indication_quarters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('connection_point_id');
            $table->year('date_year');
            $table->double('year');
            $table->double('quarter_1');
            $table->double('quarter_2');
            $table->double('quarter_3');
            $table->double('quarter_4');
            $table->double('january');
            $table->double('february');
            $table->double('march');
            $table->double('april');
            $table->double('may');
            $table->double('june');
            $table->double('july');
            $table->double('august');
            $table->double('september');
            $table->double('october');
            $table->double('november');
            $table->double('december');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indication_quarters');
    }
};
