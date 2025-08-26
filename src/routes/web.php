<?php
use Illuminate\Support\Facades\Route;


Route::get('crud-stats', [\imransaleem\CrudGenerator\Http\Controllers\CrudStatsController::class, 'index']);
