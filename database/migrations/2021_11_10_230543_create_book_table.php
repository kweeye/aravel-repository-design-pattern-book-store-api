<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('category_id')->comment('relation book category');
            $table->integer('author_id')->comment('relation book autor');
            $table->integer('tag_id')->nullable()->comment('book tag');
            $table->string('name')->comment('book name');
            $table->text('short_description')->nullable();
            $table->text('image')->nullable()->comment('author image');
            $table->string('status')->default('unpublish')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('book');
    }
}
