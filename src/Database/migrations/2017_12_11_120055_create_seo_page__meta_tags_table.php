<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeoPageMetaTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo_page_meta_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('seo_page_id')->unsigned()->nullable();
            $table->integer('seo_meta_tag_id')->unsigned();
            $table->text('content')->nullable();
            $table->foreign('seo_page_id')->references('id')->on('seo_pages')->onDelete('set null');
            $table->foreign('seo_meta_tag_id')->references('id')->on('seo_meta_tags')->onDelete('cascade');
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
        Schema::dropIfExists('seo_page_meta_tags');
    }
}
