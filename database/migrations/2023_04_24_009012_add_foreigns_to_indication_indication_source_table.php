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
        Schema::table('indication_indication_source', function (
            Blueprint $table
        ) {
            $table
                ->foreign('indication_id')
                ->references('id')
                ->on('indications')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('indication_source_id')
                ->references('id')
                ->on('indication_sources')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('indication_indication_source', function (
            Blueprint $table
        ) {
            $table->dropForeign(['indication_id']);
            $table->dropForeign(['indication_source_id']);
        });
    }
};
