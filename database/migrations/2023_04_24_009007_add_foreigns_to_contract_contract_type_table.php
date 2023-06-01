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
        Schema::table('contract_contract_type', function (Blueprint $table) {
            $table
                ->foreign('contract_id')
                ->references('id')
                ->on('contracts')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('contract_type_id')
                ->references('id')
                ->on('contract_types')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contract_contract_type', function (Blueprint $table) {
            $table->dropForeign(['contract_id']);
            $table->dropForeign(['contract_type_id']);
        });
    }
};
