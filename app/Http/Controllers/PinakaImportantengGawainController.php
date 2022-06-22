<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\AgriExtensionCompetenciesRecord;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Inertia\Inertia;
use Illuminate\Support\Facades\Session;

class PinakaImportantengGawainController extends Controller
{

    public function assessment_form()
    {
        return Inertia::render('pig/2022/AssessmentForm', ['distinct_function_titles' => $this->get_distinct_function_titles()]);
    }

    private function get_distinct_function_titles()
    {
        $records = AgriExtensionCompetenciesRecord::select('function_title')->distinct()->get();

        $distinct_function_titles = [];
        foreach ($records as $value) {
            $distinct_function_titles[] = $value["function_title"];
        }

        return $distinct_function_titles;
    }

    public function report()
    {

        return Inertia::render('pig/2022/Report');
    }

    public function assessment_form_edit($id)
    {
        $form = AgriExtensionCompetenciesRecord::find($id);

        $edit_form = [
            "id" => $form->id,
            "name" => $form->name,
            "function_title" => $form->function_title,
            "yos_agri_extension" => $form->yos_agri_extension,
            "mos_agri_extension" => $form->mos_agri_extension,
            "yos_current_position" => $form->yos_current_position,
            "mos_current_position" => $form->mos_current_position,
            "age" => $form->age,
            "gender" => $form->gender,
            "competencies" => [
                "a_program_planning_0" => $form->a_program_planning_0,
                "a_program_planning_1" => $form->a_program_planning_1,
                "a_program_planning_2" => $form->a_program_planning_2,
                "b_program_implementation_0" => $form->b_program_implementation_0,
                "b_program_implementation_1" => $form->b_program_implementation_1,
                "b_program_implementation_2" => $form->b_program_implementation_2,
                "b_program_implementation_3" => $form->b_program_implementation_3,
                "b_program_implementation_4" => $form->b_program_implementation_4,
                "c_communication_skills_0" => $form->c_communication_skills_0,
                "c_communication_skills_1" => $form->c_communication_skills_1,
                "c_communication_skills_2" => $form->c_communication_skills_2,
                "c_communication_skills_3" => $form->c_communication_skills_3,
                "c_communication_skills_4" => $form->c_communication_skills_4,
                "c_communication_skills_5" => $form->c_communication_skills_5,
                "d_education_and_information_technology_0" => $form->d_education_and_information_technology_0,
                "d_education_and_information_technology_1" => $form->d_education_and_information_technology_1,
                "d_education_and_information_technology_2" => $form->d_education_and_information_technology_2,
                "d_education_and_information_technology_3" => $form->d_education_and_information_technology_3,
                "d_education_and_information_technology_4" => $form->d_education_and_information_technology_4,
                "d_education_and_information_technology_5" => $form->d_education_and_information_technology_5,
                "d_education_and_information_technology_6" => $form->d_education_and_information_technology_6,
                "d_education_and_information_technology_7" => $form->d_education_and_information_technology_7,
                "e_program_evaluation_0" => $form->e_program_evaluation_0,
                "e_program_evaluation_1" => $form->e_program_evaluation_1,
                "e_program_evaluation_2" => $form->e_program_evaluation_2,
                "e_program_evaluation_3" => $form->e_program_evaluation_3,
                "e_program_evaluation_5" => $form->e_program_evaluation_5,
                "e_program_evaluation_4" => $form->e_program_evaluation_4,
                "f_personal_and_professional_development_0" => $form->f_personal_and_professional_development_0,
                "f_personal_and_professional_development_1" => $form->f_personal_and_professional_development_1,
                "f_personal_and_professional_development_2" => $form->f_personal_and_professional_development_2,
                "f_personal_and_professional_development_3" => $form->f_personal_and_professional_development_3,
                "f_personal_and_professional_development_4" => $form->f_personal_and_professional_development_4,
                "g_diversity_0" => $form->g_diversity_0,
                "g_diversity_1" => $form->g_diversity_1,
                "g_diversity_2" => $form->g_diversity_2,
                "g_diversity_3" => $form->g_diversity_3,
                "g_diversity_4" => $form->g_diversity_4,
                "h_technical_subject_matter_expertise_0" => $form->h_technical_subject_matter_expertise_0,
                "h_technical_subject_matter_expertise_1" => $form->h_technical_subject_matter_expertise_1,
                "h_technical_subject_matter_expertise_2" => $form->h_technical_subject_matter_expertise_2,
                "h_technical_subject_matter_expertise_3" => $form->h_technical_subject_matter_expertise_3,
                "h_technical_subject_matter_expertise_4" => $form->h_technical_subject_matter_expertise_4
            ],
            "i_additional_information" => $form->i_additional_information,
            "j_additional_information" => [
                "j_additional_information_0" => $form->j_additional_information_0,
                "j_additional_information_1" => $form->j_additional_information_1,
                "j_additional_information_2" => $form->j_additional_information_2,
                "j_additional_information_3" => $form->j_additional_information_3
            ],
            "k_additional_information" => $form->k_additional_information
        ];

        return Inertia::render(
            'pig/2022/AssessmentForm',
            [
                "edit_form" => $edit_form,
                'distinct_function_titles' => $this->get_distinct_function_titles()
            ]
        );
    }

    public function assessment_forms($edit_status = null)
    {
        return Inertia::render('pig/2022/AssessmentForms', ["distinct_function_titles" => $this->get_distinct_function_titles(), "edit_status" => $edit_status, "encoded_forms" => $this->get_encoded_forms(), "all_encoded_forms" => $this->get_all_encoded_forms()]);
    }


    public function assessment_form_store(Request $form)
    {
        if ($form->id) {

            $record = AgriExtensionCompetenciesRecord::find($form->id);
            $record->name = $form->name;
            $record->function_title = $form->function_title;
            $record->yos_agri_extension = isset($form->yos_agri_extension) ? $form->yos_agri_extension : null;
            $record->mos_agri_extension = isset($form->mos_agri_extension) ? $form->mos_agri_extension : null;
            $record->yos_current_position = isset($form->yos_current_position) ? $form->yos_current_position : null;
            $record->mos_current_position = isset($form->mos_current_position) ? $form->mos_current_position : null;
            $record->age = isset($form->age) ? $form->age : null;
            $record->gender = isset($form->gender) ? $form->gender : null;
            $record->a_program_planning_0 = isset($form->competencies['a_program_planning_0']) ? $form->competencies['a_program_planning_0'] : null;
            $record->a_program_planning_1 = isset($form->competencies['a_program_planning_1']) ? $form->competencies['a_program_planning_1'] : null;
            $record->a_program_planning_2 = isset($form->competencies['a_program_planning_2']) ? $form->competencies['a_program_planning_2'] : null;
            $record->b_program_implementation_0 = isset($form->competencies['b_program_implementation_0']) ? $form->competencies['b_program_implementation_0'] : null;
            $record->b_program_implementation_1 = isset($form->competencies['b_program_implementation_1']) ? $form->competencies['b_program_implementation_1'] : null;
            $record->b_program_implementation_2 = isset($form->competencies['b_program_implementation_2']) ? $form->competencies['b_program_implementation_2'] : null;
            $record->b_program_implementation_3 = isset($form->competencies['b_program_implementation_3']) ? $form->competencies['b_program_implementation_3'] : null;
            $record->b_program_implementation_4 = isset($form->competencies['b_program_implementation_4']) ? $form->competencies['b_program_implementation_4'] : null;
            $record->c_communication_skills_0 = isset($form->competencies['c_communication_skills_0']) ? $form->competencies['c_communication_skills_0'] : null;
            $record->c_communication_skills_1 = isset($form->competencies['c_communication_skills_1']) ? $form->competencies['c_communication_skills_1'] : null;
            $record->c_communication_skills_2 = isset($form->competencies['c_communication_skills_2']) ? $form->competencies['c_communication_skills_2'] : null;
            $record->c_communication_skills_3 = isset($form->competencies['c_communication_skills_3']) ? $form->competencies['c_communication_skills_3'] : null;
            $record->c_communication_skills_4 = isset($form->competencies['c_communication_skills_4']) ? $form->competencies['c_communication_skills_4'] : null;
            $record->c_communication_skills_5 = isset($form->competencies['c_communication_skills_5']) ? $form->competencies['c_communication_skills_5'] : null;
            $record->d_education_and_information_technology_0 = isset($form->competencies['d_education_and_information_technology_0']) ? $form->competencies['d_education_and_information_technology_0'] : null;
            $record->d_education_and_information_technology_1 = isset($form->competencies['d_education_and_information_technology_1']) ? $form->competencies['d_education_and_information_technology_1'] : null;
            $record->d_education_and_information_technology_2 = isset($form->competencies['d_education_and_information_technology_2']) ? $form->competencies['d_education_and_information_technology_2'] : null;
            $record->d_education_and_information_technology_3 = isset($form->competencies['d_education_and_information_technology_3']) ? $form->competencies['d_education_and_information_technology_3'] : null;
            $record->d_education_and_information_technology_4 = isset($form->competencies['d_education_and_information_technology_4']) ? $form->competencies['d_education_and_information_technology_4'] : null;
            $record->d_education_and_information_technology_5 = isset($form->competencies['d_education_and_information_technology_5']) ? $form->competencies['d_education_and_information_technology_5'] : null;
            $record->d_education_and_information_technology_6 = isset($form->competencies['d_education_and_information_technology_6']) ? $form->competencies['d_education_and_information_technology_6'] : null;
            $record->d_education_and_information_technology_7 = isset($form->competencies['d_education_and_information_technology_7']) ? $form->competencies['d_education_and_information_technology_7'] : null;
            $record->e_program_evaluation_0 = isset($form->competencies['e_program_evaluation_0']) ? $form->competencies['e_program_evaluation_0'] : null;
            $record->e_program_evaluation_1 = isset($form->competencies['e_program_evaluation_1']) ? $form->competencies['e_program_evaluation_1'] : null;
            $record->e_program_evaluation_2 = isset($form->competencies['e_program_evaluation_2']) ? $form->competencies['e_program_evaluation_2'] : null;
            $record->e_program_evaluation_3 = isset($form->competencies['e_program_evaluation_3']) ? $form->competencies['e_program_evaluation_3'] : null;
            $record->e_program_evaluation_5 = isset($form->competencies['e_program_evaluation_5']) ? $form->competencies['e_program_evaluation_5'] : null;
            $record->e_program_evaluation_4 = isset($form->competencies['e_program_evaluation_4']) ? $form->competencies['e_program_evaluation_4'] : null;
            $record->f_personal_and_professional_development_0 = isset($form->competencies['f_personal_and_professional_development_0']) ? $form->competencies['f_personal_and_professional_development_0'] : null;
            $record->f_personal_and_professional_development_1 = isset($form->competencies['f_personal_and_professional_development_1']) ? $form->competencies['f_personal_and_professional_development_1'] : null;
            $record->f_personal_and_professional_development_2 = isset($form->competencies['f_personal_and_professional_development_2']) ? $form->competencies['f_personal_and_professional_development_2'] : null;
            $record->f_personal_and_professional_development_3 = isset($form->competencies['f_personal_and_professional_development_3']) ? $form->competencies['f_personal_and_professional_development_3'] : null;
            $record->f_personal_and_professional_development_4 = isset($form->competencies['f_personal_and_professional_development_4']) ? $form->competencies['f_personal_and_professional_development_4'] : null;
            $record->g_diversity_0 = isset($form->competencies['g_diversity_0']) ? $form->competencies['g_diversity_0'] : null;
            $record->g_diversity_1 = isset($form->competencies['g_diversity_1']) ? $form->competencies['g_diversity_1'] : null;
            $record->g_diversity_2 = isset($form->competencies['g_diversity_2']) ? $form->competencies['g_diversity_2'] : null;
            $record->g_diversity_3 = isset($form->competencies['g_diversity_3']) ? $form->competencies['g_diversity_3'] : null;
            $record->g_diversity_4 = isset($form->competencies['g_diversity_4']) ? $form->competencies['g_diversity_4'] : null;
            $record->h_technical_subject_matter_expertise_0 = isset($form->competencies['h_technical_subject_matter_expertise_0']) ? $form->competencies['h_technical_subject_matter_expertise_0'] : null;
            $record->h_technical_subject_matter_expertise_1 = isset($form->competencies['h_technical_subject_matter_expertise_1']) ? $form->competencies['h_technical_subject_matter_expertise_1'] : null;
            $record->h_technical_subject_matter_expertise_2 = isset($form->competencies['h_technical_subject_matter_expertise_2']) ? $form->competencies['h_technical_subject_matter_expertise_2'] : null;
            $record->h_technical_subject_matter_expertise_3 = isset($form->competencies['h_technical_subject_matter_expertise_3']) ? $form->competencies['h_technical_subject_matter_expertise_3'] : null;
            $record->h_technical_subject_matter_expertise_4 = isset($form->competencies['h_technical_subject_matter_expertise_4']) ? $form->competencies['h_technical_subject_matter_expertise_4'] : null;
            $record->i_additional_information = isset($form->i_additional_information) ? $form->i_additional_information : null;
            $record->j_additional_information_0 = isset($form->j_additional_information['j_additional_information_0']) ? $form->j_additional_information['j_additional_information_0'] : null;
            $record->j_additional_information_1 = isset($form->j_additional_information['j_additional_information_1']) ? $form->j_additional_information['j_additional_information_1'] : null;
            $record->j_additional_information_2 = isset($form->j_additional_information['j_additional_information_2']) ? $form->j_additional_information['j_additional_information_2'] : null;
            $record->j_additional_information_3 = isset($form->j_additional_information['j_additional_information_3']) ? $form->j_additional_information['j_additional_information_3'] : null;
            $record->k_additional_information = isset($form->k_additional_information) ? $form->k_additional_information : null;

            $record->save();

            return $this->assessment_forms('updated');
            // return Inertia::render('pig/2022/AssessmentForm',['edit_status'=>'updated']);
        }

        $record = new AgriExtensionCompetenciesRecord;
        $record->name = $form->name;
        $record->function_title = $form->function_title;
        $record->yos_agri_extension = isset($form->yos_agri_extension) ? $form->yos_agri_extension : null;
        $record->mos_agri_extension = isset($form->mos_agri_extension) ? $form->mos_agri_extension : null;
        $record->yos_current_position = isset($form->yos_current_position) ? $form->yos_current_position : null;
        $record->mos_current_position = isset($form->mos_current_position) ? $form->mos_current_position : null;
        $record->age = isset($form->age) ? $form->age : null;
        $record->gender = isset($form->gender) ? $form->gender : null;
        $record->a_program_planning_0 = isset($form->competencies['a_program_planning_0']) ? $form->competencies['a_program_planning_0'] : null;
        $record->a_program_planning_1 = isset($form->competencies['a_program_planning_1']) ? $form->competencies['a_program_planning_1'] : null;
        $record->a_program_planning_2 = isset($form->competencies['a_program_planning_2']) ? $form->competencies['a_program_planning_2'] : null;
        $record->b_program_implementation_0 = isset($form->competencies['b_program_implementation_0']) ? $form->competencies['b_program_implementation_0'] : null;
        $record->b_program_implementation_1 = isset($form->competencies['b_program_implementation_1']) ? $form->competencies['b_program_implementation_1'] : null;
        $record->b_program_implementation_2 = isset($form->competencies['b_program_implementation_2']) ? $form->competencies['b_program_implementation_2'] : null;
        $record->b_program_implementation_3 = isset($form->competencies['b_program_implementation_3']) ? $form->competencies['b_program_implementation_3'] : null;
        $record->b_program_implementation_4 = isset($form->competencies['b_program_implementation_4']) ? $form->competencies['b_program_implementation_4'] : null;
        $record->c_communication_skills_0 = isset($form->competencies['c_communication_skills_0']) ? $form->competencies['c_communication_skills_0'] : null;
        $record->c_communication_skills_1 = isset($form->competencies['c_communication_skills_1']) ? $form->competencies['c_communication_skills_1'] : null;
        $record->c_communication_skills_2 = isset($form->competencies['c_communication_skills_2']) ? $form->competencies['c_communication_skills_2'] : null;
        $record->c_communication_skills_3 = isset($form->competencies['c_communication_skills_3']) ? $form->competencies['c_communication_skills_3'] : null;
        $record->c_communication_skills_4 = isset($form->competencies['c_communication_skills_4']) ? $form->competencies['c_communication_skills_4'] : null;
        $record->c_communication_skills_5 = isset($form->competencies['c_communication_skills_5']) ? $form->competencies['c_communication_skills_5'] : null;
        $record->d_education_and_information_technology_0 = isset($form->competencies['d_education_and_information_technology_0']) ? $form->competencies['d_education_and_information_technology_0'] : null;
        $record->d_education_and_information_technology_1 = isset($form->competencies['d_education_and_information_technology_1']) ? $form->competencies['d_education_and_information_technology_1'] : null;
        $record->d_education_and_information_technology_2 = isset($form->competencies['d_education_and_information_technology_2']) ? $form->competencies['d_education_and_information_technology_2'] : null;
        $record->d_education_and_information_technology_3 = isset($form->competencies['d_education_and_information_technology_3']) ? $form->competencies['d_education_and_information_technology_3'] : null;
        $record->d_education_and_information_technology_4 = isset($form->competencies['d_education_and_information_technology_4']) ? $form->competencies['d_education_and_information_technology_4'] : null;
        $record->d_education_and_information_technology_5 = isset($form->competencies['d_education_and_information_technology_5']) ? $form->competencies['d_education_and_information_technology_5'] : null;
        $record->d_education_and_information_technology_6 = isset($form->competencies['d_education_and_information_technology_6']) ? $form->competencies['d_education_and_information_technology_6'] : null;
        $record->d_education_and_information_technology_7 = isset($form->competencies['d_education_and_information_technology_7']) ? $form->competencies['d_education_and_information_technology_7'] : null;
        $record->e_program_evaluation_0 = isset($form->competencies['e_program_evaluation_0']) ? $form->competencies['e_program_evaluation_0'] : null;
        $record->e_program_evaluation_1 = isset($form->competencies['e_program_evaluation_1']) ? $form->competencies['e_program_evaluation_1'] : null;
        $record->e_program_evaluation_2 = isset($form->competencies['e_program_evaluation_2']) ? $form->competencies['e_program_evaluation_2'] : null;
        $record->e_program_evaluation_3 = isset($form->competencies['e_program_evaluation_3']) ? $form->competencies['e_program_evaluation_3'] : null;
        $record->e_program_evaluation_5 = isset($form->competencies['e_program_evaluation_5']) ? $form->competencies['e_program_evaluation_5'] : null;
        $record->e_program_evaluation_4 = isset($form->competencies['e_program_evaluation_4']) ? $form->competencies['e_program_evaluation_4'] : null;
        $record->f_personal_and_professional_development_0 = isset($form->competencies['f_personal_and_professional_development_0']) ? $form->competencies['f_personal_and_professional_development_0'] : null;
        $record->f_personal_and_professional_development_1 = isset($form->competencies['f_personal_and_professional_development_1']) ? $form->competencies['f_personal_and_professional_development_1'] : null;
        $record->f_personal_and_professional_development_2 = isset($form->competencies['f_personal_and_professional_development_2']) ? $form->competencies['f_personal_and_professional_development_2'] : null;
        $record->f_personal_and_professional_development_3 = isset($form->competencies['f_personal_and_professional_development_3']) ? $form->competencies['f_personal_and_professional_development_3'] : null;
        $record->f_personal_and_professional_development_4 = isset($form->competencies['f_personal_and_professional_development_4']) ? $form->competencies['f_personal_and_professional_development_4'] : null;
        $record->g_diversity_0 = isset($form->competencies['g_diversity_0']) ? $form->competencies['g_diversity_0'] : null;
        $record->g_diversity_1 = isset($form->competencies['g_diversity_1']) ? $form->competencies['g_diversity_1'] : null;
        $record->g_diversity_2 = isset($form->competencies['g_diversity_2']) ? $form->competencies['g_diversity_2'] : null;
        $record->g_diversity_3 = isset($form->competencies['g_diversity_3']) ? $form->competencies['g_diversity_3'] : null;
        $record->g_diversity_4 = isset($form->competencies['g_diversity_4']) ? $form->competencies['g_diversity_4'] : null;
        $record->h_technical_subject_matter_expertise_0 = isset($form->competencies['h_technical_subject_matter_expertise_0']) ? $form->competencies['h_technical_subject_matter_expertise_0'] : null;
        $record->h_technical_subject_matter_expertise_1 = isset($form->competencies['h_technical_subject_matter_expertise_1']) ? $form->competencies['h_technical_subject_matter_expertise_1'] : null;
        $record->h_technical_subject_matter_expertise_2 = isset($form->competencies['h_technical_subject_matter_expertise_2']) ? $form->competencies['h_technical_subject_matter_expertise_2'] : null;
        $record->h_technical_subject_matter_expertise_3 = isset($form->competencies['h_technical_subject_matter_expertise_3']) ? $form->competencies['h_technical_subject_matter_expertise_3'] : null;
        $record->h_technical_subject_matter_expertise_4 = isset($form->competencies['h_technical_subject_matter_expertise_4']) ? $form->competencies['h_technical_subject_matter_expertise_4'] : null;
        $record->i_additional_information = isset($form->i_additional_information) ? $form->i_additional_information : null;
        $record->j_additional_information_0 = isset($form->j_additional_information['j_additional_information_0']) ? $form->j_additional_information['j_additional_information_0'] : null;
        $record->j_additional_information_1 = isset($form->j_additional_information['j_additional_information_1']) ? $form->j_additional_information['j_additional_information_1'] : null;
        $record->j_additional_information_2 = isset($form->j_additional_information['j_additional_information_2']) ? $form->j_additional_information['j_additional_information_2'] : null;
        $record->j_additional_information_3 = isset($form->j_additional_information['j_additional_information_3']) ? $form->j_additional_information['j_additional_information_3'] : null;
        $record->k_additional_information = isset($form->k_additional_information) ? $form->k_additional_information : null;
        $record->cookie_id = Session::getId();

        $record->save();
        return Inertia::render('pig/2022/AssessmentForm', ['distinct_function_titles' => $this->get_distinct_function_titles(), 'edit_status' => 'created']);
        // return redirect('/pig/2022/assessment-form',[]);
    }

    private function get_encoded_forms()
    {
        $forms = AgriExtensionCompetenciesRecord::where('cookie_id', Session::getId())
            ->orderByDesc('updated_at')
            ->get();
        return count($forms) > 0 ? $forms : [];
    }
    private function get_all_encoded_forms()
    {
        $forms = AgriExtensionCompetenciesRecord::orderByDesc('updated_at')->get();
        return count($forms) > 0 ? $forms : [];
    }
}
