<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgriExtensionCompetenciesRecord extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "name",
        "function_title",
        "yos_agri_extension",
        "mos_agri_extension",
        "yos_current_position",
        "mos_current_position",
        "age",
        "gender",
        "a_program_planning_0",
        "a_program_planning_1",
        "a_program_planning_2",
        "b_program_implementation_0",
        "b_program_implementation_1",
        "b_program_implementation_2",
        "b_program_implementation_3",
        "b_program_implementation_4",
        "c_communication_skills_0",
        "c_communication_skills_1",
        "c_communication_skills_2",
        "c_communication_skills_3",
        "c_communication_skills_4",
        "c_communication_skills_5",
        "d_education_and_information_technology_0",
        "d_education_and_information_technology_1",
        "d_education_and_information_technology_2",
        "d_education_and_information_technology_3",
        "d_education_and_information_technology_4",
        "d_education_and_information_technology_5",
        "d_education_and_information_technology_6",
        "d_education_and_information_technology_7",
        "e_program_evaluation_0",
        "e_program_evaluation_1",
        "e_program_evaluation_2",
        "e_program_evaluation_3",
        "e_program_evaluation_5",
        "e_program_evaluation_4",
        "f_personal_and_professional_development_0",
        "f_personal_and_professional_development_1",
        "f_personal_and_professional_development_2",
        "f_personal_and_professional_development_3",
        "f_personal_and_professional_development_4",
        "g_diversity_0",
        "g_diversity_1",
        "g_diversity_2",
        "g_diversity_3",
        "g_diversity_4",
        "h_technical_subject_matter_expertise_0",
        "h_technical_subject_matter_expertise_1",
        "h_technical_subject_matter_expertise_2",
        "h_technical_subject_matter_expertise_3",
        "h_technical_subject_matter_expertise_4",
        "i_additional_information",
        "j_additional_information_0",
        "j_additional_information_1",
        "j_additional_information_2",
        "j_additional_information_3",
        "k_additional_information",
        "created_by",
        "cookie_id"
    ];
}
