<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgriExtensionCompetenciesRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agri_extension_competencies_records', function (Blueprint $table) {
            $table->id();
            $table->text("name")->nullable();
            $table->text("function_title")->nullable();
            $table->integer("yos_agri_extension")->nullable();
            $table->integer("mos_agri_extension")->nullable();
            $table->integer("yos_current_position")->nullable();
            $table->integer("mos_current_position")->nullable();
            $table->integer("age")->nullable();
            $table->text("gender")->nullable();
            $table->text("a_program_planning_0")->nullable();
            $table->text("a_program_planning_1")->nullable();
            $table->text("a_program_planning_2")->nullable();
            $table->text("b_program_implementation_0")->nullable();
            $table->text("b_program_implementation_1")->nullable();
            $table->text("b_program_implementation_2")->nullable();
            $table->text("b_program_implementation_3")->nullable();
            $table->text("b_program_implementation_4")->nullable();
            $table->text("c_communication_skills_0")->nullable();
            $table->text("c_communication_skills_1")->nullable();
            $table->text("c_communication_skills_2")->nullable();
            $table->text("c_communication_skills_3")->nullable();
            $table->text("c_communication_skills_4")->nullable();
            $table->text("c_communication_skills_5")->nullable();
            $table->text("d_education_and_information_technology_0")->nullable();
            $table->text("d_education_and_information_technology_1")->nullable();
            $table->text("d_education_and_information_technology_2")->nullable();
            $table->text("d_education_and_information_technology_3")->nullable();
            $table->text("d_education_and_information_technology_4")->nullable();
            $table->text("d_education_and_information_technology_5")->nullable();
            $table->text("d_education_and_information_technology_6")->nullable();
            $table->text("d_education_and_information_technology_7")->nullable();
            $table->text("e_program_evaluation_0")->nullable();
            $table->text("e_program_evaluation_1")->nullable();
            $table->text("e_program_evaluation_2")->nullable();
            $table->text("e_program_evaluation_3")->nullable();
            $table->text("e_program_evaluation_5")->nullable();
            $table->text("e_program_evaluation_4")->nullable();
            $table->text("f_personal_and_professional_development_0")->nullable();
            $table->text("f_personal_and_professional_development_1")->nullable();
            $table->text("f_personal_and_professional_development_2")->nullable();
            $table->text("f_personal_and_professional_development_3")->nullable();
            $table->text("f_personal_and_professional_development_4")->nullable();
            $table->text("g_diversity_0")->nullable();
            $table->text("g_diversity_1")->nullable();
            $table->text("g_diversity_2")->nullable();
            $table->text("g_diversity_3")->nullable();
            $table->text("g_diversity_4")->nullable();
            $table->text("h_technical_subject_matter_expertise_0")->nullable();
            $table->text("h_technical_subject_matter_expertise_1")->nullable();
            $table->text("h_technical_subject_matter_expertise_2")->nullable();
            $table->text("h_technical_subject_matter_expertise_3")->nullable();
            $table->text("h_technical_subject_matter_expertise_4")->nullable();
            $table->text("i_additional_information")->nullable();
            $table->text("j_additional_information_0")->nullable();
            $table->text("j_additional_information_1")->nullable();
            $table->text("j_additional_information_2")->nullable();
            $table->text("j_additional_information_3")->nullable();
            $table->text("k_additional_information")->nullable();
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
        Schema::dropIfExists('agri_extension_competencies_records');
    }
}
