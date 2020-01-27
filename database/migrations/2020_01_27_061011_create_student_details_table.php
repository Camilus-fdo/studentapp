<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('std_id');
            $table->string('std_first_name');
            $table->string('std_last_name');
            $table->string('std_full_name');
            $table->dateTime('std_birthday');
            $table->string('std_gender');
            $table->string('std_address');
            $table->string('std_contact_mobile');
            $table->string('std_contact_home');
            $table->string('std_email');
            $table->timestamps();
            $table->integer('std_active_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_details');
    }
}
