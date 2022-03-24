<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('sub_category_id');
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('unit_id');
            $table->string('code');
            $table->string('name');
            $table->double('buying_price', 15,2);
            $table->double('selling_price', 15,2);
            $table->double('min_stock', 15, 5)->nullable();
            $table->string('photo')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1 = active, 0 = inactive');
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('sub_category_id')->references('id')->on('sub_categories');
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->foreign('unit_id')->references('id')->on('units');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
