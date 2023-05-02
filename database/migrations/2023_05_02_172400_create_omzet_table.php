<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOmzetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('omzet', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_cabang')->nullable();
            $table->foreign('id_cabang')->references('id')->on('cabangs');
            $table->integer('omzet')->nullable();
            $table->date('date');
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
        Schema::dropIfExists('omzet');
    }
}
