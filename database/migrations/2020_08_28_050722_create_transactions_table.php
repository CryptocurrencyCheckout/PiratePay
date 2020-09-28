<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->smallInteger('status');

            $table->string('store_currency', 10);
            $table->string('store_order_id', 60);
            $table->string('store_order_price', 30);
            $table->string('store_buyer_name', 100);
            $table->string('store_buyer_email', 100);

            $table->string('crypto_address', 80);

            $table->string('crypto_market_price', 30);
            $table->string('crypto_price', 30);

            $table->string('start_balance', 30)->nullable();
            $table->string('end_balance', 30)->nullable();

            $table->string('crypto_received', 30)->nullable();
            $table->string('crypto_expected', 30)->nullable();
            $table->string('crypto_percent', 30)->nullable();

            $table->longText('crypto_qr')->nullable();
            $table->longText('callback')->nullable();

            $table->smallInteger('wallet_checks')->nullable();
            $table->smallInteger('transmitted')->nullable();

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
        Schema::dropIfExists('transactions');
    }
}
