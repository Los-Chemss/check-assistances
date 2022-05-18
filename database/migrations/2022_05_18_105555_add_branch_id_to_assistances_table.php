<?php

use App\Models\Branch;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBranchIdToAssistancesTable extends Migration
{
    public function up()
    {
        Schema::table('assistances', function (Blueprint $table) {

            $branch = new Branch();
            $branch->division = 'otra';
            $branch->save();

            $table->unsignedBigInteger('branch_id')->default($branch->id);
            $table->foreign('branch_id')->references('id')->on('branches');
        });
    }
    public function down()
    {
        Schema::table('assistances', function (Blueprint $table) {
            $table->dropForeign(['branch_id']);
            $table->dropColumn('branch_id');
        });
    }
}
