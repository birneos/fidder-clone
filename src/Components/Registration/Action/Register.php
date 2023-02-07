<?php
declare(strict_types=1);
namespace PhpFidder\Core\Registration\Action;

use PhpFidder\Core\Registration\Event\RegistrationSuccessEvent;
use PhpFidder\Core\Registration\Request\RegisterRequest;
use PhpFidder\Core\Registration\Response\RegisterResponse;
use PhpFidder\Core\Registration\Validator\RegisterValidator;
use Laminas\Diactoros\Response\RedirectResponse;
use PhpFidder\Core\Renderer\TemplateRendererInterface;
use PhpFidder\Core\Repository\UserRepository;
use PhpFidder\Core\Registration\Hydrator\UserHydrator;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;



final class Register{

    public function __construct(
        private readonly RegisterValidator $validator,
        private readonly UserHydrator $userHydrator,
        private readonly UserRepository $userRepository,
        private readonly EventDispatcherInterface $eventDispatcher
        ){

    }
    public function __invoke(ServerRequestInterface $request):ResponseInterface{

        $oRequest = new RegisterRequest($request);

        $isUser = $this->userRepository->isUserExist($oRequest->getUsername());
        $isEmail = $this->userRepository->isEmailExist($oRequest->getEmail());


        if($oRequest->isPostRequest() && $this->validator->isValid($oRequest, $isUser, $isEmail)){

            //user erstellen
            //redirect irgendwo hin

           $user =  $this->userHydrator->hydrate($oRequest->toArray());
            $this->userRepository->add($user);
            $this->userRepository->persist();

           # $event = new RegistrationSuccessEvent($user);
           # $this->eventDispatcher->dispatch($event);

            return new RedirectResponse('/');
        }

        //erhalte geclonetes immutable $oRequest Object, so können wir sicher
        //gehen, wenn mehre Middleware oder Änderungen auf dem Request Object stattfinden
        //das wir ein unverändertes Object bekommen
       $oRequest = $oRequest->withErros($this->validator->getErrors());

        return new RegisterResponse($oRequest);


    }
}