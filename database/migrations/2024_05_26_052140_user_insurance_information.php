<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserInsuranceInformation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_insurance_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('ensure_id');
            $table->enum('insurance_type', ['mandatory', 'optional']);
            $table->foreignId('medical_insurance_category_id');
            $table->string('medical_insurance_number');
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->timestamps();

            $table->foreign('doctor_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_insurance');

    }
}
