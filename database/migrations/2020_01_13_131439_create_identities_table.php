<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdentitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('identities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->timestamp('dob')->nullable();
            $table->string('email', 100)->nullable();
            $table->string('phone_number', 10)->nullable();
            $table->softDeletes()->nullable();
            $table->timestamps();

            $table->foreign('user_id')->on('users')
                ->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('identities');
    }
}
