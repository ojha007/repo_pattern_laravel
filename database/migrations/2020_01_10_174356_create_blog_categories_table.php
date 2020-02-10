<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->string('name')->unique();
            $table->mediumText('description');
            $table->integer('parent_id')->nullable()->unsigned();
            $table->foreign('parent_id')
                ->references('id')->on('blog_categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->auditableWithDeletes();
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
        Schema::dropIfExists('blog_categories');
    }
}
