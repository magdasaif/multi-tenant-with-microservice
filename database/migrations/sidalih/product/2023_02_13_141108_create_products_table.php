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
            $table->id();
            $table->foreignId('category_id')->references('id')->on('categories')->nullable();
            $table->foreignId('brand_id')->references('id')->on('brands')->nullable();
            $table->foreignId('unit_id')->references('id')->on('units')->nullable();

            // $table->foreignId('status_id')->references('id')->on('status')->nullable();
            $table->unsignedBigInteger('status_id')->nullable(); // foreign key that accepts null values
            $table->foreign('status_id')->references('id')->on('status')->onDelete('set null');


            $table->string('name');
            $table->string('description');
            $table->string('code');
            $table->float('price');
            $table->integer('points')->default(0);
            $table->boolean('has_tax')->default(1);
            $table->boolean('most_selling')->default(1);
            $table->boolean('recently_arrived')->default(1);
            $table->boolean('whole_sale_offer')->default(0);
            $table->boolean('returnable')->default(0); //product can recall or not
            $table->integer('sort');
            $table->integer('active');
            $table->integer('min_quantity');
            $table->integer('max_quantity');
            $table->float('stock');
            $table->float('weight');
            $table->string('slug');
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
