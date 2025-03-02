<?php

use Illuminate\Support\Facades\Route;
use RapidCMS\Core\Http\Controllers\SettingController;

Route::get("rapid-cms", [SettingController::class, 'index'])->name('rapid-cms.settings.index');
