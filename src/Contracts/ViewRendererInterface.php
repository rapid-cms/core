<?php

namespace RapidCMS\Core\Contracts;

interface ViewRendererInterface
{
    /**
     * Render a view with the provided data.
     *
     * @param  string  $view  The view name or component identifier.
     * @param  array  $data  The data to pass to the view.
     * @return mixed
     */
    public function render(string $view, array $data = []);
}
