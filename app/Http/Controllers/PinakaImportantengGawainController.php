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

    public function report()
    {
        $competencies = [
            [
                "id" => "program_planning",
                "questions" => [
                    [
                        "question" =>
                        "Pamilyar ba kamo sa panan-awon, misyon, programa, mga palisiya ug mga tumong sa mga serbisyo sa agri-extension.",
                        "choices" => ["oo", "medyo", "dili"],
                    ],
                    [
                        "question" =>
                        "Makahimo sa pagpa-apil sa mga hingtungdan sa pagpahigayon sa mga pagtimbang-timbang sa mga panginahanglan.",
                        "choices" => ["oo", "medyo", "dili"],
                    ],
                    [
                        "question" =>
                        "Makahimo sa pagpa-apil sa mga local development partners sama sa NGOs, women groups, ug kooperatiba sa extension program.",
                        "choices" => ["oo", "medyo", "dili"],
                    ],
                ],
            ],
            [
                "id" => "program_implementation",
                "questions" => [
                    [
                        "question" =>
                        "Pag-pakita ug kahanas sa pagtinabangay aron makab-ot ang mga resulta sa agri-extension.",
                        "choices" => ["oo", "medyo", "dili"],
                    ],
                    [
                        "question" =>
                        "Pag-apil sa mga lokal nga stakeholders sa pagpatuman sa mga kalihokan sa agri-extension program.",
                        "choices" => ["oo", "medyo", "dili"],
                    ],
                    [
                        "question" =>
                        "Ipakita ang mga kahanas sa negosasyon aron makab-ot ang konsensus ug masulbad ang mga panagbangi.",
                        "choices" => ["oo", "medyo", "dili"],
                    ],
                    [
                        "question" =>
                        "Pagtugyan sa mga responsibilidad ngadto sa mga kauban kon gikinahanglan.",
                        "choices" => ["oo", "medyo", "dili"],
                    ],
                    [
                        "question" =>
                        "Makahimo sa pag-apil sa mga babaye nga mag-uuma ug mga miyembro sa minorya nga mga grupo sa mga buluhaton sa agri-extension.",
                        "choices" => ["oo", "medyo", "dili"],
                    ],
                ],
            ],
            [
                "id" => "communication_skills",
                "questions" => [
                    [
                        "question" =>
                        "Pagtahud sa mga lokal nga kultura samtang nakigsulti sa mga kliyente.",
                        "choices" => ["oo", "medyo", "wala"],
                    ],
                    [
                        "question" =>
                        "Pag-andam matag bulan/quarterly/tinuig nga mga progress reports sa mga trabaho sa agri-extension.",
                        "choices" => ["oo", "medyo", "wala"],
                    ],
                    [
                        "question" =>
                        "Pagpaambit sa mga impormasyon sa kalampusan ug mga leksyon nga nakat-unan sa mga stakesholder pinaagi sa mga nagkalain-laing media.",
                        "choices" => ["oo", "medyo", "wala"],
                    ],
                    [
                        "question" =>
                        "Paggamit ug nagkalain-laing mga agianan sa komunikasyon aron ipakaylap ang impormasyon bahin sa importanteng mga kalihokan ug programa sa agri-extension (pananglitan, adlaw sa uma sa mga mag-uuma, epidemya sa sakit ug peste).",
                        "choices" => ["oo", "medyo", "wala"],
                    ],
                    [
                        "question" =>
                        "Pagbaton ug kahanas sa maayo nga pagpaminaw sa tanang kliyente ug stakeholders.",
                        "choices" => ["oo", "medyo", "wala"],
                    ],
                    [
                        "question" => "Pagpakita ug kahanas sa pagsulti sa publiko.",
                        "choices" => ["oo", "medyo", "wala"],
                    ],
                ],
            ],
            [
                "id" => "education_and_information_technology",
                "questions" => [
                    [
                        "question" =>
                        "Paggamit ug Microsoft excel alang sa data entry ug data analysis.",
                        "choices" => ["oo", "wala"],
                    ],
                    [
                        "question" =>
                        "Paggamit ug Microsoft Word alang sa word processing (e.g. pag-type, pag-edit, pag-imprenta) ug graphic design.",
                        "choices" => ["oo", "wala"],
                    ],
                    [
                        "question" =>
                        "Paggamit ug Microsoft Powerpoint aron sa paghimo og mga presentasyon.",
                        "choices" => ["oo", "wala"],
                    ],
                    [
                        "question" =>
                        "Paggamit ug Audio-visual aid sama sa mga tsart, mga graph, ug mga puppet show alang sa pagtudlo ug pagkat-on.",
                        "choices" => ["oo", "wala"],
                    ],
                    [
                        "question" =>
                        "Paggamit ug mass media sama sa mga estasyon sa radyo sa FM ug mga channel sa telebisyon alang sa komunikasyon.",
                        "choices" => ["oo", "wala"],
                    ],
                    [
                        "question" =>
                        "Paggamit ug kompyuter (email, internet, ug mga webpage) para sa komunikasyon.",
                        "choices" => ["oo", "wala"],
                    ],
                    [
                        "question" =>
                        "Paggamit ug mobile phone services (pananglitan, pag-text, serbisyo sa SMS) para sa komunikasyon.",
                        "choices" => ["oo", "wala"],
                    ],
                    [
                        "question" =>
                        "Paggamint sa mga modernong kahimanan sa paghimo sa fieldwork (GPS, Soil Tester, pH meter).",
                        "choices" => ["oo", "wala"],
                    ],
                ],
            ],
            [
                "id" => "program_evaluation",
                "questions" => [
                    [
                        "question" =>
                        "Pagpahigayon ug monitoring and evaluation sa agri-extension programs.",
                        "choices" => ["oo", "wala"],
                    ],
                    [
                        "question" =>
                        "Pagpalambo og mga instrumento sa pagkolekta sa datos gikan sa pagmonitor ug pagtimbang-timbang sa mga trabaho sa agri-extension.",
                        "choices" => ["oo", "wala"],
                    ],
                    [
                        "question" =>
                        "Pag-apply sa mga qualitative tools and techniques (pananglitan, focus group discussion, in-depth interview, etc.) aron makolekta ang evaluation data.",
                        "choices" => ["oo", "wala"],
                    ],
                    [
                        "question" =>
                        "Pag-apply ug quantitative tools and techniques (pananglitan, survey, interbyu, datos sa uma) aron makolekta ang evaluation data.",
                        "choices" => ["oo", "wala"],
                    ],
                    [
                        "question" =>
                        "Pag-analisar sa datos (kwalitatibo ug quantitative), paghubad sa datos, ug pagsulat sa evaluation report.",
                        "choices" => ["oo", "wala"],
                    ],
                    [
                        "question" =>
                        "Pagpaambit sa evaluation report sulod sa organisasyon ug sa mga stakeholders.",
                        "choices" => ["oo", "wala"],
                    ],
                ],
            ],
            [
                "id" => "personal_and_professional_development",
                "questions" => [
                    [
                        "question" =>
                        "Pagpraktis sa mga prinsipyo sa good governance (pananglitan, partisipasyon sa mga kliyente, tulubagon sa mga kliyente, transparency).",
                        "choices" => ["oo", "wala"],
                    ],
                    [
                        "question" =>
                        "Pagpakita ug pasalig sa pag-uswag sa karera (participate in lifelong-learning, in-service training programs, propesyonal nga miting, ug mga komperensya.",
                        "choices" => ["oo", "wala"],
                    ],
                    [
                        "question" =>
                        "Pag-apply ug propesyonal nga pamatasan sa trabaho, ie, ipasiugda ang rekomendasyon nga nakabase sa panukiduki o teknolohiya, pagkamatinud-anon, ug integridad.",
                        "choices" => ["oo", "wala"],
                    ],
                    [
                        "question" =>
                        "Pagsunod sa mga polisiya ug direktiba sa organisasyon alang sa in-service training ug professional development.",
                        "choices" => ["oo", "wala"],
                    ],
                    [
                        "question" => "Nagakuha ug post-grad studies, CSC/Board Exams?",
                        "choices" => ["oo", "wala"],
                    ],
                ],
            ],
            [
                "id" => "diversity",
                "questions" => [
                    [
                        "question" =>
                        "Pagsabot nga ang pagkalain-lain (diversity) anaa sa sulod ug taliwala sa mga kliyente ug mga stakeholder.",
                        "choices" => ["oo", "medyo", "wala"],
                    ],
                    [
                        "question" =>
                        "Pag-ila sa mga panginahanglan sa kababayen-an, gagmay nga mga mag-uuma, ug minoriya nga mga grupo.",
                        "choices" => ["oo", "medyo", "wala"],
                    ],
                    [
                        "question" =>
                        "Pag-develop sa mga agri-extension programs aron makabenepisyo ang mga babayeng mag-uuma.",
                        "choices" => ["oo", "medyo", "wala"],
                    ],
                    [
                        "question" =>
                        "Pag-paapil sa nagkalain-laing social ug marginalized nga mga grupo sa agri-extension programs.",
                        "choices" => ["oo", "medyo", "wala"],
                    ],
                    [
                        "question" =>
                        "Pagtinabangay uban ang nagkadaiyang empleyado sa departamento.",
                        "choices" => ["oo", "medyo", "wala"],
                    ],
                ],
            ],
            [
                "id" => "technical_subject_matter_expertise",
                "questions" => [
                    [
                        "question" =>
                        "Pagpakita nga sila adunay sukaranan nga kahibalo sa ilang disiplina (eg, mga tanum, kahayupan, IPM, ug uban pa).",
                        "choices" => ["oo", "medyo", "wala"],
                    ],
                    [
                        "question" =>
                        "Pagsabot sa bag-ong teknolohiya nga gipasiugda, i.e., unsa kini, ngano, ug giunsa kini paglihok.",
                        "choices" => ["oo", "medyo", "wala"],
                    ],
                    [
                        "question" =>
                        "Makahimo sa pag-edukar sa mga miyembro sa komunidad mahitungod sa lain-laing mga matang sa mga risgo ug kawalay kasiguruhan (tungod sa pagbag-o sa klima, pag-usab-usab sa merkado, ug mga katalagman).",
                        "choices" => ["oo", "medyo", "wala"],
                    ],
                    [
                        "question" =>
                        "Pagtan-aw ug paggamit sa mga publikasyon -- mga journal, mga research reports, ug uban pa.",
                        "choices" => ["oo", "medyo", "wala"],
                    ],
                    [
                        "question" =>
                        "Pagpakita ug sukaranan nga kahibalo sa mga agribusiness, ug pagtabang sa pagpalambo sa entrepreneurship sa mga kliyente.",
                        "choices" => ["oo", "medyo", "wala"],
                    ],
                ],
            ],
        ];

        // $oo_bg_color = "#42a5f5";
        // $medyo_bg_color = "#2db900";
        // $dili_wala_bg_color = "#7a7a7a";
        $colors = [
            "oo" => "#42a5f5",
            "medyo" => "#2db900",
            "dili" => "#7a7a7a",
            "wala" => "#7a7a7a"
        ];

        $letters = ["a", "b", "c", "d", "e", "f", "g", "h"];

        foreach ($competencies as $k => $competency) {

            foreach ($competency["questions"] as $q => $question) {

                $data = [
                    "labels" => [],
                    "datasets" => [
                        [
                            "label" => "",
                            "backgroundColor" => ["#42A5F5", "#42A5F5", "#42A5F5"],
                            "data" => [],
                        ]
                    ],
                ];

                $field_name = $letters[$k] . "_" . $competency["id"] . "_" . $q;

                $competencies[$k]["questions"][$q]["field_name"] = $field_name;

                $backgroundColor = [];
                foreach ($question["choices"] as $c => $choice) {
                    $count = AgriExtensionCompetenciesRecord::where($field_name, "=", $choice)->get()->count();
                    $backgroundColor[] =  $colors[$choice];
                    $data["labels"][] = mb_convert_case($choice, MB_CASE_TITLE) . " ($count)";
                    $data["datasets"][0]["backgroundColor"] = $backgroundColor;
                    $data["datasets"][0]["data"][] = $count;
                }

                $competencies[$k]["questions"][$q]["data"] =  $data;
            }
        }

        $stacked_data = [
            "labels" => [],
            "datasets" => [
                [
                    "type" => "bar",
                    "label" => "Oo",
                    "backgroundColor" => "#42A5F5",
                    "respondents" => [],
                    "data" => []
                ],
                [
                    "type" => "bar",
                    "label" => "Medyo",
                    "backgroundColor" => "#00c50f",
                    "respondents" => [],
                    "data" => []
                ],
                [
                    "type" => "bar",
                    "label" => "Wala/Dili",
                    "backgroundColor" => "#d50000",
                    "respondents" => [],
                    "data" => []
                ]

            ],
            "totals" => []

        ];


        foreach ($competencies as $key => $competency) {
            $stacked_data["labels"][] = mb_convert_case($competency["id"], MB_CASE_UPPER);

            foreach ($competency["questions"] as $q => $question) {
                if (!isset($stacked_data["datasets"][0]["respondents"][$key])) {
                    $stacked_data["datasets"][0]["respondents"][$key] = 0;
                }
                if (!isset($stacked_data["datasets"][1]["respondents"][$key])) {
                    $stacked_data["datasets"][1]["respondents"][$key] = 0;
                }
                if (!isset($stacked_data["datasets"][2]["respondents"][$key])) {
                    $stacked_data["datasets"][2]["respondents"][$key] = 0;
                }
                // if (!isset($stacked_data["totals"][$key])) {
                //     $stacked_data["totals"][$key] = 0;
                // }

                $total = 0;

                $stacked_data["datasets"][0]["respondents"][$key] += $question["data"]["datasets"][0]["data"][0];
                $total += $stacked_data["datasets"][0]["respondents"][$key];
                // check first if choices has only two choices
                // if choices are 3

                if (count($question["choices"]) == 3) {
                    $stacked_data["datasets"][1]["respondents"][$key] += $question["data"]["datasets"][0]["data"][1];
                    $total += $stacked_data["datasets"][1]["respondents"][$key];
                    $stacked_data["datasets"][2]["respondents"][$key] += $question["data"]["datasets"][0]["data"][2];
                    $total += $stacked_data["datasets"][2]["respondents"][$key];
                }
                // if choices are 2
                else {
                    $stacked_data["datasets"][1]["respondents"][$key] = 0;
                    // $stacked_data["totals"][$key] += 0;
                    $stacked_data["datasets"][2]["respondents"][$key] += $question["data"]["datasets"][0]["data"][1];
                    $total +=  $stacked_data["datasets"][2]["respondents"][$key];
                }

                $stacked_data["totals"][$key] = $total;
            }

            // get respondents percentile for each datasets

            foreach ($stacked_data["datasets"] as $k => $choice) {
                $stacked_data["datasets"][$k]["data"][$key] = round(($choice["respondents"][$key] / $stacked_data["totals"][$key])*100);
            }
        }

        // foreach ($competencies as $key => $competency) {

        // }
        $i_additional_information = $this->get_i_additional_information();
        $k_additional_information = $this->get_k_additional_information();

        return Inertia::render('pig/2022/Report', ['stacked_data' => $stacked_data, 'chart_data' => $competencies, 'i_additional_information' => $i_additional_information, 'k_additional_information' => $k_additional_information]);
    }

    private function get_i_additional_information()
    {
        $data = [];
        $comments = AgriExtensionCompetenciesRecord::where('i_additional_information', '!=', null)->get('i_additional_information');
        foreach ($comments as $comment) {
            if (strlen($comment['i_additional_information']) > 8) {
                $data[] = $comment['i_additional_information'];
            }
        }
        return $data;
    }

    private function get_k_additional_information()
    {
        $data = [];
        $comments = AgriExtensionCompetenciesRecord::where('k_additional_information', '!=', null)->get('k_additional_information');
        foreach ($comments as $comment) {
            if (strlen($comment['k_additional_information']) > 8) {
                $data[] = $comment['k_additional_information'];
            }
        }
        return $data;
    }
}
