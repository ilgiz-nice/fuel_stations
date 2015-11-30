<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('table');
            $table->dateTime('datetime');
            $table->timestamps();
        });

        DB::table('logs')->insert(
            [
                'table' => 'orgs',
                'datetime' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        );
        DB::table('logs')->insert(
            [
                'table' => 'fuel',
                'datetime' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('logs');
    }
}
