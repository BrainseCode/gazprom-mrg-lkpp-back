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
        Schema::table('transfer_indications', function (Blueprint $table) {
            $table
                ->foreign('measuring_complex_id')
                ->references('id')
                ->on('measuring_complexes')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transfer_indications', function (Blueprint $table) {
            $table->dropForeign(['measuring_complex_id']);
        });
    }
};
