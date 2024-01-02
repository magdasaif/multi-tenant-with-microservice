<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartMoreDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('cart_more_details', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('cart_id')->references('id')->on('carts')->nullable();
            $table->foreignId('cart_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('cart_item_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('set null');
            $table->enum('action_type',['coupon','sale_offer','offer','tax','points','cash_back','product','extra_details']);
            $table->float('start_price')->default(0)->comment('cart start price without any discount or tax');
            $table->float('action_value')->default(0)->comment('will be value of discount with (- value) , otherwise value will be (+ value) ');
            $table->float('final_price')->default(0)->comment('cart final price after all operation done');
            $table->string('more_details')->comment('here we will store coupon code if applied ')->nullable();
            $table->string('action_notes')->nullable();
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
        Schema::dropIfExists('cart_more_details');
    }
}
