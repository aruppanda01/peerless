<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyInLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->dropColumn('c_user_id');
            $table->dropColumn('o_user_id');
            $table->dropColumn('is_modify_details');
            $table->dropColumn('status');
            $table->dropColumn('a_verified_dept');
            $table->dropColumn('o_verified_dept');
            $table->dropColumn('c_verified_dept');
        });
        Schema::table('loans', function (Blueprint $table) {
            $table->tinyInteger('is_modify_details_by_credit_dept')->nullable()->after('revert_department')->comment('0:Not modified,1:modified.');
            $table->tinyInteger('is_modify_details_by_operation_dept')->nullable()->after('revert_department')->comment('0:Not modified,1:modified.');
            $table->tinyInteger('status')->after('c_verified_by')->comment('1:Process By Credit Dept,2:Revert back,3:Process By Operation Dept,4:Process By Account Dept ');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->dropColumn('is_modify_details_by_credit_dept');
            $table->dropColumn('is_modify_details_by_operation_dept');
            $table->dropColumn('status');
        });
    }
}
