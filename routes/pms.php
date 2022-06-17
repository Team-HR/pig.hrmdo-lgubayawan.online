<?php

use App\Http\Controllers\RatingScaleMatrixController;
use Illuminate\Support\Facades\Route;


Route::get('/rating-scale-matrix', [RatingScaleMatrixController::class, 'index']);
