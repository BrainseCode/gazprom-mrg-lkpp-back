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
        Schema::create('request_approval_unevennesses', function (
            Blueprint $table
        ) {
            $table->bigIncrements('id');
            $table->double('gas_volume');
            $table->double('gas_volume_unallocated');
            $table->double('total');
            $table->unsignedBigInteger('user_id');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_approval_unevennesses');
    }
};
