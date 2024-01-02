<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelatedFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('related_features', function (Blueprint $table) {
            $table->id();
            // $table->morphs('featurable');
            $table->foreignId('product_id')->references('id')->on('products');
            $table->foreignId('feature_id')->references('id')->on('features');
            $table->foreignId('feature_attribut_id')->references('id')->on('feature_attributes');
            $table->string('value');
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
        Schema::dropIfExists('related_features');
    }
}
