<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJabatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jabatans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jabatan');
            $table->integer('gapok');
            $table->integer('tunjangan_makmur');
            $table->integer('tunjangan_makan');
            $table->integer('tunjangan_transportasi');
            $table->integer('tunjangan_lembur');
            $table->integer('tunjangan_menikah');
            $table->integer('tunjangan_anak');
            $table->integer('bonus_tahunan');
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
        Schema::dropIfExists('jabatans');
    }
}
