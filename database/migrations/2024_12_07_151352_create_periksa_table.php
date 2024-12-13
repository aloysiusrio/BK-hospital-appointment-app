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
        Schema::create('periksa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('daftar_poli_id')->constrained('daftar_poli')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('tgl_periksa');
            $table->text('catatan');
            $table->decimal('jumlah', 20, 2)->default(0);
            $table->decimal('biaya_periksa', 20, 2)->default(0);
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
        Schema::dropIfExists('periksa');
    }
};
