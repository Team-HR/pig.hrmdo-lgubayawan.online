<?php

use App\Http\Controllers\PinakaImportantengGawainController;
use Illuminate\Support\Facades\Route;


Route::get('/pig/2022/assessment-form', [PinakaImportantengGawainController::class, 'assessment_form']);
Route::get('/pig/2022/assessment-form/edit/{id}', [PinakaImportantengGawainController::class, 'assessment_form_edit']);
Route::get('/pig/2022/assessment-forms', [PinakaImportantengGawainController::class, 'assessment_forms']);

Route::post('/pig/2022/assessment-form', [PinakaImportantengGawainController::class, 'assessment_form_store']);
// Route::post('/', [PinakaImportantengGawainController::class, 'store_assessment']);

Route::get('/pig/2022/assessment-report', [PinakaImportantengGawainController::class, 'report']);