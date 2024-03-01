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
        Schema::table('produks', function (Blueprint $table) {
            $table->dropForeign(['kategori_id']);
            $table->softDeletes();
        });

        Schema::table('transaksi_details', function (Blueprint $table) {
            $table->dropForeign(['produk_id']);
            $table->softDeletes();
        });

        Schema::table('transaksis', function (Blueprint $table) {
            $table->dropForeign(['pelanggan_id']);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produks', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->foreign('kategori_id')->references('id')->on('kategoris');
        });

        Schema::table('transaksi_details', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->foreign('produk_id')->references('id')->on('produks');
        });

        Schema::table('transaksis', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->foreign('pelanggan_id')->references('id')->on('pelanggans');
        });
    }
};
