<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVerifiedColumnInLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->bigInteger('c_verified_by')->after('comment_on_irregularity')->nullable()->comment('The form is verified by whom form credit team');
            $table->bigInteger('c_verified_dept')->after('comment_on_irregularity')->nullable()->comment('Verified Department form credit team');
            $table->tinyInteger('c_verified_status')->after('comment_on_irregularity')->default(0)->nullable()->comment('0:Not Verified,1:Verified form credit team');

            $table->bigInteger('o_verified_by')->after('comment_on_irregularity')->nullable()->comment('The form is verified by whom form operation team');
            $table->bigInteger('o_verified_dept')->after('comment_on_irregularity')->nullable()->comment('Verified Department form operation team');
            $table->tinyInteger('o_verified_status')->after('comment_on_irregularity')->default(0)->nullable()->comment('0:Not Verified,1:Verified form operation team');
            
            $table->bigInteger('a_verified_by')->after('comment_on_irregularity')->nullable()->comment('The form is verified by form appointment team');
            $table->bigInteger('a_verified_dept')->after('comment_on_irregularity')->nullable()->comment('Verified Department form appointment team');
            $table->tinyInteger('a_verified_status')->after('comment_on_irregularity')->default(0)->nullable()->comment('0:Not Verified,1:Verified form appointment team');
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
            $table->dropColumn('c_verified_by');
            $table->dropColumn('c_verified_dept');
            $table->dropColumn('c_verified_status');

            $table->dropColumn('o_verified_by');
            $table->dropColumn('o_verified_dept');
            $table->dropColumn('o_verified_status');

            $table->dropColumn('a_verified_by');
            $table->dropColumn('a_verified_dept');
            $table->dropColumn('a_verified_status');
        });
    }
}
