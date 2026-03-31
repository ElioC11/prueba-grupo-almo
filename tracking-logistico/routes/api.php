<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TrackingController;

Route::get('/tracking/{tracking_number}', [TrackingController::class, 'track']);