<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {

            $table->id();

            $table->integer('cart_id');
            // $table->unsignedBigInteger('user_id')->nullable();
            $table->integer('user_id')->nullable();

            $table->integer('country_id')->default(Config::get('storesetting.country_id'))->comment('1 is the id of KSA');

            // $table->foreignId('payment_method_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('set null');
            // $table->foreignId('shipping_company_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('set null');
            $table->integer('payment_method_id')->nullable();
            $table->integer('shipping_company_id')->nullable();

            $table->foreignId('order_status_id')->default(1)->nullable()->constrained()->onUpdate('cascade')->onDelete('set null');

            $table->enum('payment_status',['paid','unpaid'])->default('unpaid');
            $table->string('order_code')->default(Carbon::now()->format('Ymd').'-0000');
            $table->longText('address')->nullable();
            $table->float('start_price')->nullable();
            $table->integer('total_price_of_offer')->nullable();
            $table->integer('total_price_without_offer')->nullable();
            $table->float('tax')->nullable()->comment('total value of taxes applied in all cart items');
            $table->string('coupon_code')->nullable();
            $table->float('coupon_discount')->nullable();
            $table->string('coupon_type')->comment('coupon type')->nullable();//here we will store type of applied coupon 
            $table->float('shipping_charges')->default(0.0);
            $table->float('charges_when_received')->default(0.0);
            $table->integer('replacement_points')->default(0);
            $table->float('points_discount')->default(0.0);
            $table->float('offer_saved_value')->default(0.0);
            $table->float('final_price_before_shipping')->nullable()->comment('اﻻجمالى غير شامل الشحن');
            $table->float('final_price')->nullable()->comment('اﻻجمالى بعد كل حاجه بما فيهم الشحن');
            $table->enum('source',['web','mobile'])->default('web');
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
        Schema::dropIfExists('orders');
    }
}
