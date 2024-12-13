<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_poli', function (Blueprint $table) {
            $table->id();
            $table->string('no_antrian')->nullable();
            $table->foreignId('pasien_id')->constrained('pasien')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('jadwal_periksa_id')->constrained('jadwal_periksa')->cascadeOnDelete()->cascadeOnUpdate();
            $table->text('keluhan');
            $table->enum('status', ['waiting', 'called', 'done', 'canceled'])->default('waiting');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daftar_poli');
    }
};
