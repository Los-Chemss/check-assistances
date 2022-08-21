<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('lastname');
            $table->string('address')->nullable();
            $table->string('province');
            $table->string('postcode');
            $table->string('phone')->nullable();
            $table->string('image',255)->nullable();
            $table->string('code')->unique();
            $table->dateTime('income')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
