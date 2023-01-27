<?php

namespace PhpFidder\Core\Renderer;

/**
 *  
 */
interface TemplateRendererInterface{

    public function render(string $templateName, mixed $data): string;

}