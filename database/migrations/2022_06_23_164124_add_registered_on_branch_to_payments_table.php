<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRegisteredOnBranchToPaymentsTable extends Migration
{

    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->unsignedBigInteger('registered_on_branch_id')->nullable();
            $table->foreign('registered_on_branch_id')->references('id')->on('branches')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign(['registered_on_branch_id']);
            $table->dropColumn('registered_on_branch_id');
        });
    }
}
