<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeoPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo_pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('path')->unique()->index();
            $table->string('object', 80)->nullable()->index();
            $table->string('object_id', 80)->nullable()->index();
            $table->string('robot_index', 50)->default('noindex')->nullable();
            $table->string('robot_follow', 50)->default('nofollow')->nullable();
            $table->string('canonical_url')->nullable();
            $table->string('title', 100)->nullable()->index();
            $table->string('title_source', 100)->nullable()->index();
            $table->string('description', 180)->nullable();
            $table->string('description_source', 180)->nullable();
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
        Schema::dropIfExists('seo_pages');
    }
}
