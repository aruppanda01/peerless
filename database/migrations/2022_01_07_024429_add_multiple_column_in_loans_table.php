<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMultipleColumnInLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->bigInteger('user_id')->nullable()->after('id');
            $table->tinyInteger('is_modify_details')->after('revert_department')->nullable()->comment('0:Not modified,1:modified.This column is used when the document revert back to the prev department');
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
            $table->dropColumn('user_id');
            $table->dropColumn('is_modify_details');
        });
    }
}
