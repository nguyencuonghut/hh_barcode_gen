<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarcodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barcode', function (Blueprint $table) {
            $table->increments('id');
            $table->string('client_name');
            $table->string('region')->nullable();
            $table->string('product_name')->nullable();
            $table->date('product_date')->nullable();
            $table->date('expired_date')->nullable();
            $table->date('selling_date');
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
        Schema::drop('barcode');
    }
}
