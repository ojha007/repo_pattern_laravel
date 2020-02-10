<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_category_id')->unsigned()->nullable();
            $table->foreign('product_category_id')->references('id')->on('product_categories');
            $table->string('abbreviation', 10)->unique()->nullable();
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->string('slug')->unique();
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
        Schema::dropIfExists('product_categories');
    }
}
