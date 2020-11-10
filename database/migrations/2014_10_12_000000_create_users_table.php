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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('user_id');
            $table->string('user_name',100);
            $table->string('user_surname',100);
            $table->string('user_id_card',50)->unique();
            $table->string('user_email',100)->unique();
            $table->string('user_phone',100)->nullable();
            $table->date('user_birth_date');
            $table->string('user_gender',100);
            $table->string('user_email_verified_at',100)->nullable();
            $table->string('password',100);
            $table->string('user_image_name')->nullable();
            $table->string('user_state', 100);
            $table->bigInteger('rol_id')->unsigned();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('rol_id')->references('rol_id')->on('rols')->onDelete('restrict')->onUpdate('restrict');
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
