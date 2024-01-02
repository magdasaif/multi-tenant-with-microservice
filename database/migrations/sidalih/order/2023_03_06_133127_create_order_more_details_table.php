<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderMoreDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('order_more_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('order_status_id')->default(1)->nullable()->constrained()->onUpdate('cascade')->onDelete('set null');

            // $table->foreignId('user_id')->default(1)->nullable()->constrained()->onUpdate('cascade')->onDelete('set null');
            $table->integer('user_id')->nullable();


            $table->string('user_role')->nullable();
            $table->string('notes')->nullable();
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
        Schema::dropIfExists('order_more_details');
    }
}
