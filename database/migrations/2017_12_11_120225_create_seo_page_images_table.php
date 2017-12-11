<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeoPageImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo_page_images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('src')->unique();
            $table->tinyInteger('width')->nullable();
            $table->tinyInteger('height')->nullable();
            $table->integer('page_id')->unsigned();
            $table->foreign('page_id')->references('id')->on('seo_pages')->onDelete('cascade');
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
        Schema::dropIfExists('seo_page_images');
    }
}
