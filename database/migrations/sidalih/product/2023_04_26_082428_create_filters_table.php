<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFiltersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filters', function (Blueprint $table) {
            $table->id();
            $table->morphs('filterable');//Category,Product
            // $table->foreignId('option_id')->references('id')->on('filter_select_options');//'multi select','radio btn','rang'
            // $table->enum('filter_type',['features','tags','attributes']);
            // $table->json('filter_type_values');

            $table->json('filter_values');
            $table->integer('active');
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
        Schema::dropIfExists('filters');
    }
}
