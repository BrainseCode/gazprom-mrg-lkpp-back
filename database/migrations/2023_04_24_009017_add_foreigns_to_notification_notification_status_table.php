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
        Schema::table('notification_notification_status', function (
            Blueprint $table
        ) {
            $table
                ->foreign('notification_id')
                ->references('id')
                ->on('notifications')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('notification_status_id')
                ->references('id')
                ->on('notification_statuses')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notification_notification_status', function (
            Blueprint $table
        ) {
            $table->dropForeign(['notification_id']);
            $table->dropForeign(['notification_status_id']);
        });
    }
};
