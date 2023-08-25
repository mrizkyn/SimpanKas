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
        Schema::create('fixedassets', function (Blueprint $table) {
            $table->id();
            $table->date('purchase_date');
            $table->unsignedBigInteger('account_id');
            $table->string('asset_name');
            $table->integer('cost');
            $table->integer('annual_deprec');

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
        Schema::dropIfExists('fixedassets');
    }
};
