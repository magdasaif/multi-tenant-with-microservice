<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeatureAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feature_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('feature_id')->references('id')->on('features');

            // $table->foreignId('unit_id')->references('id')->on('units')->nullable();

            $table->unsignedBigInteger('unit_id')->nullable();
            $table->foreign('unit_id')->references('id')->on('units');

            $table->enum('data_type',['int','string','bool','colorPicker']);
            $table->integer('active');
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
        Schema::dropIfExists('feature_attributes');
    }
}
