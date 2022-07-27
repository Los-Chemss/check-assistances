<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSelledProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selled_products', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity')->default(1);
            $table->decimal('price', 15, 2)->default('0.00');
            $table->float('discount')->default('0.00');
            $table->float('tax')->default('0.00');
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
        Schema::dropIfExists('selled_products');
    }
}
