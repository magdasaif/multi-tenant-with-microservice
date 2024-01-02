<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //this table only done to store necessary data just when apply coupon not listen action
        Schema::create('cart_coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('type');
            $table->string('related_users')->comment('coupon related users')->nullable();
            $table->string('rules')->nullable();
            $table->boolean('apply_with_free_shipping')->default(false)->comment('apply with free shipping');
            $table->boolean('apply_with_sale_offers')->default(false)->comment('apply with sale offers');
            $table->float('minimum_order_price')->comment('minimum order price without tax');
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
        Schema::dropIfExists('cart_coupons');
    }
}
