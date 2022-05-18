<?php

use App\Models\Customer;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCustomerIdToAssistancesTable extends Migration
{
    public function up()
    {
        Schema::table('assistances', function (Blueprint $table) {
            $company = new Customer();
            $company->name = 'Otras';
            $company->code = '0000';
            $company->save();

            $table->unsignedBigInteger('customer_id')->default($company->id);
            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }


    public function down()
    {
        Schema::table('assistances', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
            $table->dropColumn('customer_id');
        });
    }
}
