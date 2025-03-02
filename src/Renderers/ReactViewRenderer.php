<?php

namespace YourPackage\Renderers;

use Inertia\Inertia;
use RapidCMS\Core\Contracts\ViewRendererInterface;

class ReactViewRenderer implements ViewRendererInterface
{
    public function render(string $view, array $data = [])
    {
        return Inertia::render("YourPackage/React/{$view}", $data);
    }
}
