<?php

use App\Models\EmployeeStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_status', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status_name');
            $table->timestamps();
        });

        Schema::table('employee_details', function (Blueprint $table) {
            $table->integer('status_id')->unsigned()->nullable()->default(null)->after('department_id');
            $table->foreign('status_id')->references('id')->on('employee_status')->onDelete('cascade')->onUpdate('cascade');
        });
        
        $status = new EmployeeStatus();
        $status->status_name = 'Permanent Employee';
        $status->save();

        $status = new EmployeeStatus();
        $status->status_name = 'Casual Employee';
        $status->save();

        $status = new EmployeeStatus();
        $status->status_name = 'Apprentice or Trainee Employee';
        $status->save();

        $status = new EmployeeStatus();
        $status->status_name = 'Employment agency staff';
        $status->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_status');
        Schema::table('employee_details', function (Blueprint $table) {
            $table->dropColumn(['status_id']);
        });
    }
}
