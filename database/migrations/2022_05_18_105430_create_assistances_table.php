<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssistancesTable extends Migration
{
    public function up()
    {
        Schema::create('assistances', function (Blueprint $table) {
            $table->id();
            $table->string('input')->nullable();
            $table->string('output')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('assistances');
    }
}
