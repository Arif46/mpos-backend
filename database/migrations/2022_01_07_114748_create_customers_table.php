<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_type_id');
            $table->string('code');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('mobile');
            $table->string('address')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1 = active, 0 = inactive');
            $table->timestamps();
            // $table->foreign('customer_type_id')->references('id')->on('customer_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
