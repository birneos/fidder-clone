<?php
namespace PhpFidder\Core\Renderer;
use Laminas\Diactoros\Response;
use PhpFidder\Core\Renderer\RenderAwareInterface;
use PhpFidder\Core\Renderer\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;


class TemplateRendererMiddleware implements MiddlewareInterface
{
    public function __construct(private readonly TemplateRendererInterface $renderer){}
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $response = $handler->handle($request);
        //RenderAwareInterfacce zu RegisterResponse hinzugefügt, um diese von anderen
        //Responsen zu unterscheiden und nun können wir hier dies Ausfiltern.
        if ($response instanceof RenderAwareInterface) {
            $body = $this->renderer->render($response->getTemplateName(), $response);

            $response = new Response();
            $response->getBody()->write($body);

            return $response;
        }

        return $response;

    }
}
