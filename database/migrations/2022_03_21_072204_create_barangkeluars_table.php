<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangkeluarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangkeluars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('barang_id');
            $table->unsignedBigInteger('catbarang_id');
            $table->unsignedBigInteger('minimarket_id');
            $table->unsignedBigInteger('gudang_id');
            $table->integer('qty');
            $table->string('foto');
            $table->integer('status');
            $table->date('date');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('barang_id')->references('id')->on('barangs');
            $table->foreign('catbarang_id')->references('id')->on('categorybarangs');
            $table->foreign('minimarket_id')->references('id')->on('minimarkets');
            $table->foreign('gudang_id')->references('id')->on('gudangs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barangkeluars_');
    }
}
