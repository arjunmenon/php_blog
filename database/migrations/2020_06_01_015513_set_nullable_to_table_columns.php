<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetNullableToTableColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->foreignId('payment_status_id')->nullable()->change();
            $table->foreignId('amount_id')->nullable()->change();
            $table->string('transaction_reference_number')->nullable()->change();
            $table->string('transaction_signature')->nullable()->change();
            $table->text('note')->nullable()->change();
            $table->text('raw_response')->nullable()->change();
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('amount_id')->nullable()->change();
            $table->renameColumn('transaction_order_number', 'transaction_reference_number');
            $table->text('note')->nullable()->change();
            $table->string('receipt')->nullable()->change();
            $table->text('raw_response')->nullable()->change();
        });
        
        Schema::table('orders', function (Blueprint $table) {
            $table->string('transaction_reference_number')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
