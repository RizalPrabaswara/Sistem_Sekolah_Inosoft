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
        Schema::create('nilais', function (Blueprint $table) {
            $table->id();
            $table->string('nama_siswa')->nullable();
            $table->string('nama_matapelajaran');
            $table->integer('nilai_latihansoal1');
            $table->integer('nilai_latihansoal2');
            $table->integer('nilai_latihansoal3');
            $table->integer('nilai_latihansoal4');
            $table->integer('nilai_ulanganharian1');
            $table->integer('nilai_ulanganharian2');
            $table->integer('nilai_ulangan_tengah_semester');
            $table->integer('nilai_ulangan_semester');
            $table->integer('nilai_akhir');
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
        Schema::dropIfExists('nilais');
    }
};
