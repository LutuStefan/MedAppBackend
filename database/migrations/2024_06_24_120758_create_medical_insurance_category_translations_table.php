<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalInsuranceCategoryTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_insurance_category_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('medical_insurance_category_id');
            $table->foreign('medical_insurance_category_id', 'category_id')
                ->references('id')
                ->on('medical_insurance_categories')
                ->onDelete('cascade');
            $table->string('locale_id');
            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_insurance_category_translations');
    }
}
