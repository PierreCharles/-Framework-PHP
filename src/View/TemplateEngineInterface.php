<?php

namespace View;

interface TemplateEngineInterface
{
    /**
     * @param $template
     * @param array $parameters
     * @return mixed
     */
    public function render($template, array $parameters = array());
}
