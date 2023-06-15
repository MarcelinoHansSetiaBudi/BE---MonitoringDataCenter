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
        Schema::table('report_monitoring', function (Blueprint $table) {
            $table->unsignedBigInteger('shift_staff_id')->after('id')->nullable();
            $table->foreign('shift_staff_id')->references('id')->on('shift_staff')->onDelete('restrict');
            $table->unsignedBigInteger('product_id')->after('shift_staff_id')->nullable();
            $table->foreign('product_id')->references('id')->on('product')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('report_monitoring', function (Blueprint $table) {
            $table->dropForeign(['shift_staff_id']);
            $table->dropColumn('shift_staff_id');
            $table->dropForeign(['product_id']);
            $table->dropColumn('product_id');
        });
    }
};
