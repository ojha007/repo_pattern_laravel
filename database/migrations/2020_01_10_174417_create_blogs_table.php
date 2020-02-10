<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->mediumText('title');
            $table->longText('description')->nullable();
            $table->integer('blog_category_id')->nullable()->unsigned();
            $table->foreign('blog_category_id')->references('id')
                ->on('blog_categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->timestamps();
            $table->auditableWithDeletes();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
