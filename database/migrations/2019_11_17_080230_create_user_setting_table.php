<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_setting', function (Blueprint $table) {
            $table->bigIncrements('setting_id');
            $table->integer('phone')->unsigned()->default(0);
            $table->integer('email')->unsigned()->default(0);
            $table->integer('physical')->unsigned()->default(0);
            $table->integer('post')->unsigned()->default(0);
            $table->integer('social_links')->unsigned()->default(0);
            $table->integer('card_link')->unsigned()->default(0);
            $table->integer('user_id')->unsigned()->default(0);
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
        Schema::dropIfExists('user_setting');
    }
}
