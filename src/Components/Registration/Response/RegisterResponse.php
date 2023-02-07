<?php

namespace PhpFidder\Core\Components\Registration\Response;

use Laminas\Diactoros\Response;

use PhpFidder\Core\Components\Registration\Request\RegisterRequest;
use PhpFidder\Core\Renderer\RenderAwareInterface;

class RegisterResponse extends Response implements RenderAwareInterface
{
    public readonly string $username;
    public readonly string $email;
    public readonly string $password;
    public readonly string $passwordRepeat;

    public readonly array $errors;

    public function __construct(RegisterRequest $request)
    {
        parent::__construct();
        $this->username = $request->getUsername();
        $this->email = $request->getEmail();
        $this->password = $request->getPassword();
        $this->passwordRepeat = $request->getPasswordRepeat();
    }


    /**
     * @return string
     */
    public function getTemplateName(): string
    {
        return 'register';
    }
}
