<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->references('id')->on('carts')->nullable();
            
            $table->enum('type',['product','sale_offer'])->default('product');
            $table->integer('product_id')->nullable();
            $table->integer('offer_id')->nullable();

            // $table->foreignId('product_id')->references('id')->on('products')->nullable();
            // // $table->foreignId('offer_id')->references('id')->on('offers')->nullable();
            // $table->foreignId('offer_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('set null');


            $table->float('price')->default(0)->comment('will be product_price or offer_price');//product price
            $table->integer('quantity')->default(0)->comment('will be 1 in case of type = sale_offer');
            $table->float('start_price')->default(0);//total before any operation
            
            $table->integer('total_price_of_offer_before_tax')->default(0)->comment('total_price_of_offer_before_tax for this product ');
            $table->integer('total_price_without_offer_before_tax')->default(0)->comment('total_price_without_offer_before_tax ');
            
            $table->integer('tax_percentage')->default(0)->comment('tax percentage for this product in selected country');//product tax percentage
            $table->float('tax_value')->default(0)->comment('tax value for this product in selected country, for all quantities');//product tax value
            
            // $table->float('total_price_after_tax')->default(0);//total after tax
            // $table->float('total_price_after_coupon')->default(0);//total after coupon
            
            $table->float('product_coupon_value')->default(0)->comment('coupon value if coupon is fixed, or coupon % if coupon is percentage ');
            // $table->float('product_coupon_value')->default(0)->comment('coupon value applied for this product for only 1 quantity');
            $table->enum('coupon_type',['fixed','percentage'])->nullable();
            $table->float('total_discount_for_coupon')->default(0);//total coupon discount
            
            $table->float('offer_saved_value')->default(0)->comment('discount of offer');

            $table->float('final_price_before_tax')->default(0)->comment('الاجمالى قبل تطبيق الضريبه');
            $table->float('final_price')->default(0)->comment('اﻻجمالى بعد تطبيق الضريبه');

            $table->json('item_related_coupons')->nullable();
            $table->boolean('event_status')->default(false)->comment('status is false untile deal wilt coupons service to retrive coupon object , then it became true');
            
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
        Schema::dropIfExists('cart_items');
    }
}
