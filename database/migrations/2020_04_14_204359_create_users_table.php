<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type')->comment('1 = employee, 2 = investor');
            $table->unsignedBigInteger('branch_id');
            $table->unsignedBigInteger('station_id');
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('mobile');
            $table->string('nid')->nullable();
            $table->double('salary', 15, 2)->default(0);
            $table->date('join_date', 15, 2);
            $table->text('address')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1 = active, 0 = inactive');
            $table->timestamps();
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->foreign('station_id')->references('id')->on('stations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}