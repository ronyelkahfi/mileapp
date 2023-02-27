<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package', function (Blueprint $table) {
            // $table->string('transaction_id')->primary();
            $table->string('customer_name');
            $table->string('customer_code');
            $table->integer('transaction_amount');
            $table->integer('transaction_discount');
            $table->string('transaction_additional_field');
            $table->integer('transaction_payment_type');
            $table->string('transaction_state');
            $table->string('transaction_code');
            $table->integer('transaction_order');
            $table->string('location_id');
            $table->integer('organization_id');
            $table->timestamps('created_at');
            $table->timestamps('updated_at');
            $table->string('transaction_payment_type_name');
            $table->integer('transaction_cash_amount');
            $table->integer('transaction_cash_change');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('package');
    }
}
