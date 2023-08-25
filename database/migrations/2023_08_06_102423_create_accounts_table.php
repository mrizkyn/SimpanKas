<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Account;


return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->integer('code_name')->unique()->nullable();
            $table->string('account_name');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->timestamps();
    
            $table->foreign('parent_id')->references('id')->on('accounts');
        });
    
    }


    public function down()
    {
        Schema::dropIfExists('accounts');
    }

    
};