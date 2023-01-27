<?php
declare(strict_types=1);
namespace PhpFidder\Core\Registration\Action;

use PhpFidder\Core\Registration\Validator\RegisterValidator;
use Laminas\Diactoros\Response\RedirectResponse;
use PhpFidder\Core\Renderer\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;


final class Register{

    public function __construct(
        private readonly TemplateRendererInterface $renderer,
        private readonly RegisterValidator $validator
        ){

    }
    public function __invoke(ServerRequestInterface $request):ResponseInterface{

        $body = [];
        if($request->getMethod() === 'POST'){
            $body = $request->getParsedBody();
            
        }
        
        $username = $body['username'] ?? '';
        $password = $body['password'] ?? '';
        $passwordRepeat = $body['passwordRepeat'] ?? '';
        $email =  $body['email'] ?? '';


        if($this->validator->isValid($username,$email, $password, $passwordRepeat)){

            //user erstellen
            //redirect irgendwo hin

           

            return new RedirectResponse('/');
        }

    $body = $this->renderer->render('register',[
        'titel'=>'Registrierung',
        'username' => $username,
        'password' => $password,
        'passwordRepeat' => $passwordRepeat,
        'email' => $email,
        'errors' => $this->validator->getErrors()

    ]);
    $response = new \Laminas\Diactoros\Response;
    $response->getBody()->write($body);
    return $response;
    }
}