<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePaydrawV2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pay_draw', function (Blueprint $table) {
            $table->unsignedInteger('type_pd')->nullable();
            $table->foreign('type_pd')
                ->references('id')
                ->on('type_paydraw')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pay_draw', function (Blueprint $table) {
            $table->dropForeign(['type_pd']);
            $table->dropColumn('type_pd');
        });
    }
}
