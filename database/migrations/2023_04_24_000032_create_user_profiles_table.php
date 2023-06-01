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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('short_name');
            $table->string('full_name');
            $table->string('responsible_person');
            $table->string('shared_phone');
            $table->string('responsible_phone');
            $table->string('legal_address');
            $table->string('postal_address');
            $table->string('inn');
            $table->string('kpp');
            $table->string('ogrn');
            $table->string('okpo');
            $table->string('okfs');
            $table->string('okato');
            $table->string('okopf');
            $table->string('oktmo');
            $table->string('okved');
            $table->string('okogu');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
