<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockInsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_ins', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_id');
            $table->integer('stock_reason_id');
            $table->string('invoice_no');
            $table->date('stockin_date');
            $table->string('document');
            $table->timestamps();
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->foreign('stock_reason_id')->references('id')->on('stock_reasons');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_ins');
    }
}
