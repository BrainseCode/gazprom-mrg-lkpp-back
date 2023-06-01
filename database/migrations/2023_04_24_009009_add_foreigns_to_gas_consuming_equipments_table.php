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
        Schema::table('gas_consuming_equipments', function (Blueprint $table) {
            $table
                ->foreign('connection_point_id')
                ->references('id')
                ->on('connection_points')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gas_consuming_equipments', function (Blueprint $table) {
            $table->dropForeign(['connection_point_id']);
        });
    }
};
