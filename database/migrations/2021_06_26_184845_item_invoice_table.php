<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ItemInvoiceTable extends Migration
{

    public function up()
    {
        Schema::create('items_invoice', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('invoice_id');
            $table->integer('quantity');
            $table->decimal('amount',9,2);

            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('invoice_id')->references('id')->on('invoices');
        });
    }

    public function down()
    {
        Schema::dropIfExists('items_invoice');
    }
}
