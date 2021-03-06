<?php

use App\Http\Controllers\ItemPerDayController;
use App\Models\Item;
use App\Models\ItemPerDay;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ItemPerDayController::class, 'today']);
Route::get('/lastWeek', [ItemPerDayController::class, 'lastWeek']);
Route::get('/lastThreeDays', [ItemPerDayController::class, 'lastThreeDays']);
Route::get('/lastMonth', [ItemPerDayController::class, 'lastMonth']);
Route::get('/yesterday', [ItemPerDayController::class, 'yesterday']);
