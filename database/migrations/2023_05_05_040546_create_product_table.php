<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->string('product_code', 18)->comment('Kode Product')->unique()->primary();
            $table->string('product_name', 30)->comment('Nama Product');
            $table->decimal('price', 6, 0)->comment('Harga Jual Produk dalam Satuan Currency');
            $table->string('currency', 5)->comment('Satuan Harga Jual');
            $table->decimal('discount', 6, 0)->comment('Diskon dalam (%)');
            $table->string('dimension', 50)->comment('dimensi produk');
            $table->string('unit', 5)->comment('Satuan Jual Produk');
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
        Schema::dropIfExists('product');
    }
}
