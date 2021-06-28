<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InvoiceTable extends Migration
{

    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('client_id');
            $table->decimal('amount',9,2)->default(0);

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('client_id')->references('id')->on('clients');
        });
    }


    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
