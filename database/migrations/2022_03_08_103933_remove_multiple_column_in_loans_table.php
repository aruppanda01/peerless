<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveMultipleColumnInLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->dropColumn('loan_type');
            $table->dropColumn('amount_of_sanction');
            $table->dropColumn('tenure');
            $table->dropColumn('whether_compliance_of_last_sanction_terms_done');
            $table->dropColumn('deviation_from_last_sanction_terms');
            $table->dropColumn('amount_O_s_as_on');
            $table->dropColumn('residual_tenure');
            $table->dropColumn('utilization_of_limit');
            $table->dropColumn('no_of_times_bounces_in_the_account');
            $table->dropColumn('any_bounces_in_last_six_months');
            $table->dropColumn('no_of_times_and_days');
            $table->dropColumn('reasons_for_the_irregularity');
            $table->dropColumn('peak_irregularity_in_the_account');
            $table->dropColumn('comment_on_irregularity');
            $table->dropColumn('comment_on_conduct');
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
            //
        });
    }
}
