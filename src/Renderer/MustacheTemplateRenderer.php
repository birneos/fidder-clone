<?php

namespace PhpFidder\Core\Renderer;

final class MustacheTemplateRenderer implements TemplateRendererInterface
{
    public function __construct(private readonly \Mustache_Engine $mustacheEngine)
    {
    }
    /**
     * @param string $templateName
     * @param mixed $data
     * @return string
     */
    public function render(string $templateName, mixed $data): string
    {
        return  $this->mustacheEngine->render($templateName, $data);
    }
}
