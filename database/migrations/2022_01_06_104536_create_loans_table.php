<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->string('borrower_name')->nullable();
            $table->string('bco_borrower_name')->nullable();
            $table->string('bguarantor_name')->nullable();
            $table->string('loan_type')->nullable();
            $table->string('amount_of_sanction')->nullable();
            $table->string('tenure')->nullable();
            $table->string('whether_compliance_of_last_sanction_terms_done')->nullable();
            $table->string('deviation_from_last_sanction_terms')->nullable();
            $table->string('amount_O_s_as_on')->nullable();
            $table->string('residual_tenure')->nullable();
            $table->string('utilization_of_limit')->nullable();
            $table->string('no_of_times_bounces_in_the_account')->nullable();
            $table->string('any_bounces_in_last_six_months')->nullable();
            $table->string('no_of_times_and_days')->nullable();
            $table->string('reasons_for_the_irregularity')->nullable();
            $table->string('peak_irregularity_in_the_account')->nullable();
            $table->string('comment_on_irregularity')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loans');
    }
}
