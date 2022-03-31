<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFakturmasuksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fakturmasuks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('suplier_id');
            $table->unsignedBigInteger('barang_id');
            $table->unsignedBigInteger('gudang_id');
            $table->unsignedBigInteger('catbarang_id');
            $table->integer('qty');
            $table->string('foto');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('suplier_id')->references('id')->on('supliers');
            $table->foreign('barang_id')->references('id')->on('barangs');
            $table->foreign('gudang_id')->references('id')->on('gudangs');
            $table->foreign('catbarang_id')->references('id')->on('categorybarangs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fakturmasuks');
    }
}
