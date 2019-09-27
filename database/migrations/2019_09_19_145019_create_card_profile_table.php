<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_profile', function (Blueprint $table) {
            $table->bigIncrements('profile_id');
            $table->string('designation', 50)->nullable();
            $table->string('full_name', 100)->nullable();
            $table->string('postion', 100)->nullable();
            $table->string('photo', 100)->nullable();
            $table->bigInteger('details_id');
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
        Schema::dropIfExists('card_profile');
    }
}
