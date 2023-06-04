<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shift_staff', function (Blueprint $table) {
            $table->unsignedBigInteger('staff_id')->after('id')->nullable();
            $table->foreign('staff_id')->references('id')->on('data_staff')->onDelete('restrict');
            $table->unsignedBigInteger('shift_id')->after('staff_id')->nullable();
            $table->foreign('shift_id')->references('id')->on('shift')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shift_staff', function (Blueprint $table) {
            $table->dropForeign(['staff_id']);
            $table->dropColumn('staff_id');
            $table->dropForeign(['shift_id']);
            $table->dropColumn('shift_id');
        });
    }
};
