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
        Schema::table('supervisor', function (Blueprint $table) {
            $table->unsignedBigInteger('report_monitoring_id')->after('name')->nullable();
            $table->foreign('report_monitoring_id')->references('id')->on('report_monitoring')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('supervisor', function (Blueprint $table) {
            $table->dropForeign(['report_monitoring_id']);
            $table->dropColumn('report_monitoring_id');
        });
    }
};
