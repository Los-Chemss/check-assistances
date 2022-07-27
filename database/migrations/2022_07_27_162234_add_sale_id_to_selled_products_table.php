<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSaleIdToSelledProductsTable extends Migration
{
    public function up()
    {
        Schema::table('selled_products', function (Blueprint $table) {
            $table->unsignedBigInteger('sale_id')->nullable();
            $table->foreign('sale_id')->references('id')->on('sales')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('selled_products', function (Blueprint $table) {
            $table->dropForeign(['sale_id']);
            $table->dropColumn('sale_id');
        });
    }
}
