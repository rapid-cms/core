<?php

namespace RapidCMS\Core\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class SettingController
{
    public function index(): Response
    {
        return Inertia::render('rapid-cms::settings/index');
    }
}
