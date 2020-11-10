<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bases', function (Blueprint $table) {
            $table->bigIncrements('base_id');
            $table->string('base_name');
            $table->string('base_measure');
            $table->string('base_colors')->nullable();
            $table->string('base_customization',100)->nullable();
            $table->string('base_description');
            $table->string('base_price');
            $table->string('base_state');
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
        Schema::dropIfExists('bases');
    }
}
