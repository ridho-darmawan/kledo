<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGajiPegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gaji_pegawais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->constrained('pegawais');
            $table->integer('total_gaji');
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
        Schema::dropIfExists('gaji_pegawais');
    }
}
