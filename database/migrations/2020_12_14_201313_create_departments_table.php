<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('employee_details', function (Blueprint $table) {
            $table->bigInteger('department_id')->unsigned()->nullable()->default(null)->after('job_id');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_details', function(Blueprint $table){
            $table->dropForeign(['department_id']);
        });
        Schema::dropIfExists('departments');

        Schema::table('employee_details', function (Blueprint $table) {
            $table->dropColumn(['department_id']);
        });
    }
}
