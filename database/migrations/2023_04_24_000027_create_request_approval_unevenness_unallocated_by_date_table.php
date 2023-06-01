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
        Schema::create(
            'request_approval_unevenness_unallocated_by_date',
            function (Blueprint $table) {
                $table->unsignedBigInteger('request_approval_unevenness_id');
                $table->unsignedBigInteger('unallocated_by_date_id');
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_approval_unevenness_unallocated_by_date');
    }
};
