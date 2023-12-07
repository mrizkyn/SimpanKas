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
        Schema::create('revision_notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('account_id');
            $table->date('date_after');
            $table->date('date');
            $table->integer('initial_nominal');
            $table->integer('revised_nominal');
            $table->string('desc');
            $table->string('noted_by');
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
        Schema::dropIfExists('revision_notes');
    }
};
