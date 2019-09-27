<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_details', function (Blueprint $table) {
            $table->bigIncrements('datails_id');
            $table->string('phone_no', 100)->nullable();
            $table->string('company', 100);
            $table->string('physical_address', 100)->nullable();
            $table->string('location', 100)->nullable();
            $table->string('post_address', 100)->nullable();
            $table->string('social_media', 100)->nullable();
            $table->string('website', 100)->nullable();
            $table->string('logo', 100)->nullable();
            $table->integer('type')->unsigned();
            $table->string('colour_1', 100);
            $table->string('colour_2', 100);
            $table->string('bg_image', 100);
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
        Schema::dropIfExists('card_details');
    }
}
