<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMembershipIdToCustomersTable extends Migration
{
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->unsignedBigInteger('membership_id')->nullable();
            $table->foreign('membership_id')->references('id')->on('memberships')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropForeign(['membership_id']);
            $table->dropColumn('membership_id');
        });
    }
}
