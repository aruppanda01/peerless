<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Add2ndTimeMultipleColumnInLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->dropColumn('revert_department');
        });
        Schema::table('loans', function (Blueprint $table) {
            $table->tinyInteger('revert_department')->nullable()->after('revert_user_id')->comment('2:Credit,3:Operation,4:Account');
            $table->bigInteger('c_user_id')->nullable()->after('user_id')->comment('If revert form by the Operation team then who is handle form the Credit team');
            $table->bigInteger('o_user_id')->nullable()->after('c_user_id')->comment('If revert form by the Accounts team then who is handle form the Operation team');
            $table->tinyInteger('status')->after('is_modify_details')->default(0)->comment('0:pending,1:Processed,2:Revert Back');
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
            $table->dropColumn('c_user_id');
            $table->dropColumn('o_user_id');
            $table->dropColumn('status');
        });
    }
}
