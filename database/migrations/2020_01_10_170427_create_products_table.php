<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_category_id')->unsigned();
            $table->foreign('product_category_id')->references('id')
                ->on('product_categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('unit_id')->nullable()->unsigned();
            $table->foreign('unit_id')->references('id')->on('units')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('description');
            $table->string('slug')->unique();
            $table->string('reference_number')->unique();
            $table->double('reorder')->nullable();
            $table->string('comment')->nullable();
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
        Schema::dropIfExists('products');
    }
}
