<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_detail', function (Blueprint $table) {
            $table->id();
            $table->string('documen_code', 3)->comment('kode dokumen');
            $table->string('documen_number', 10)->comment('nomer dokumen');
            $table->string('product_code', 18)->comment('kode product');
            $table->decimal('price', 6, 0)->comment('harga jual produk dalam satuan currency');
            $table->integer('quantity')->length(6)->comment('jumlah qty barang yang dibeli');
            $table->string('unit', 5)->comment('satuan jual produk');
            $table->decimal('sub_total', 10, 0)->comment('total harga jual per Item');
            $table->string('currency', 5)->comment('satuan harga');
            $table->timestamps();

            $table->foreign('documen_number')->references('documen_number')->on('transaction_header');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_detail');
    }
}
