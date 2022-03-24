<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockOutDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_out_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stock_out_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('supplier_id');
            $table->text('product_info')->nullable();
            $table->string('stock_no');
            $table->string('invoice_no');
            $table->double('quantity');
            $table->date('expare_date')->nullable();
            $table->date('alert_date')->nullable();
            $table->double('purchase_price', 15, 2);
            $table->double('sell_price', 15, 2);
            $table->timestamps();
            $table->foreign('stock_out_id')->references('id')->on('stock_outs');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_out_details');
    }
}
