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
        Schema::create('pay_totals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('pay_delivered');
            $table->double('pay_planned');
            $table->double('pay_tovdgo');
            $table->double('total');
            $table->double('total_nds');
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
        Schema::dropIfExists('pay_totals');
    }
};
