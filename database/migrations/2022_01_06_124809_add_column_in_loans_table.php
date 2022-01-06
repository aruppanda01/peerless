<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->bigInteger('revert_user_id')->nullable()->after('id')->comment('if they found any error they always can revert it back to the corresponding department');
            $table->tinyInteger('revert_department')->nullable()->after('revert_user_id')->comment('1:Credit,2:Operation,3:Account');
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
           $table->dropColumn('revert_user_id');
           $table->dropColumn('revert_department');
        });
    }
}
