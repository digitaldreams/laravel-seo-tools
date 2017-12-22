<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeoMetaTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo_meta_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->nullable();
            $table->string('property', 100)->nullable();
            // either active or inactive
            $table->string('status', 50)->default('active');
            $table->string('group', 50)->nullable();
            $table->string('input_type', 50)->default('text');
            $table->string('default_value')->nullable();
            $table->string('input_placeholder')->nullable();
            $table->string('input_label')->nullable();
            $table->string('input_info')->nullable();
            // either page or global
            $table->string('visibility', 50)->default('page');
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
        Schema::dropIfExists('seo_meta_tags');
    }
}
