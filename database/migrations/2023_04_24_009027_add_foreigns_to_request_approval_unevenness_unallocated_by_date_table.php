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
        Schema::table(
            'request_approval_unevenness_unallocated_by_date',
            function (Blueprint $table) {
                $table
                    ->foreign(
                        'request_approval_unevenness_id',
                        'foreign_alias_0000001'
                    )
                    ->references('id')
                    ->on('request_approval_unevennesses')
                    ->onUpdate('CASCADE')
                    ->onDelete('CASCADE');

                $table
                    ->foreign('unallocated_by_date_id', 'foreign_alias_0000002')
                    ->references('id')
                    ->on('unallocated_by_dates')
                    ->onUpdate('CASCADE')
                    ->onDelete('CASCADE');
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table(
            'request_approval_unevenness_unallocated_by_date',
            function (Blueprint $table) {
                $table->dropForeign(['request_approval_unevenness_id']);
                $table->dropForeign(['unallocated_by_date_id']);
            }
        );
    }
};
