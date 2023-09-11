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
        Schema::create('expenditures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('account_id');
            $table->bigInteger('nominal_exp');
            $table->string('exp_desc');
            $table->date('date');
            $table->integer('asset_period')->nullable();
            $table->integer('annual_dep')->nullable();
            $table->integer('dep_month')->nullable();

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
        Schema::dropIfExists('expenditures');
    }
};
