<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->timestamps();
        });

        $data[] = [
            'id' => 1,
            'name' => 'Admin',
            'slug' => 'admin'
        ];
        $data[] = [
            'id' => 2,
            'name' => 'Credit',
            'slug' => 'credit'
        ];
        $data[] = [
            'id' => 3,
            'name' => 'Operation',
            'slug' => 'operation'
        ];
        $data[] = [
            'id' => 4,
            'name' => 'Account',
            'slug' => 'account'
        ];

        DB::table('roles')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
