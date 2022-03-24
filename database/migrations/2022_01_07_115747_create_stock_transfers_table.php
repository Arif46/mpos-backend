<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_transfers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('from_branch_id');
            $table->unsignedBigInteger('to_branch_id');
            $table->unsignedBigInteger('stock_reason_id');
            $table->string('invoice_no');
            $table->date('transfer_date');
            $table->string('document');
            $table->timestamps();
            $table->foreign('from_branch_id')->references('id')->on('branches');
            $table->foreign('to_branch_id')->references('id')->on('branches');
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
        Schema::dropIfExists('stock_transfers');
    }
}
