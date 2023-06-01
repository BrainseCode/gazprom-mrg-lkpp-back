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
        Schema::create('pay_gas_delivereds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->double('summ');
            $table->boolean('status_pay');
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
        Schema::dropIfExists('pay_gas_delivereds');
    }
};
