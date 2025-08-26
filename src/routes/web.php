<?php
use Illuminate\Support\Facades\Route;


Route::get('crud-stats', [\Imransaleem\CrudGenerator\Http\Controllers\CrudStatsController::class, 'index']);
