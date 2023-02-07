<?php

namespace PhpFidder\Core\Components\Registration\Request;

use Psr\Http\Message\ServerRequestInterface;

class RegisterRequest
{
    private readonly string $username;
    private readonly string $email;
    private readonly string $password;
    private readonly string $passwordRepeat;
    private readonly string $method;

    private readonly array $errors;

    public function __construct(ServerRequestInterface $request)
    {
        $body = [];
        $body = $request->getParsedBody();
        $this->method = $request->getMethod();

        $this->username = $body['username'] ?? '';
        $this->password = $body['password'] ?? '';
        $this->passwordRepeat = $body['passwordRepeat'] ?? '';
        $this->email =  $body['email'] ?? '';
    }

    public function toArray()
    {
        return [
            'username' => $this->getUsername(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
            'passwordRepeat' => $this->getPasswordRepeat(),

        ];
    }

    public function isPostRequest()
    {
        return ($this->method === 'POST');
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getPasswordRepeat()
    {
        return $this->passwordRepeat;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    //Klasse wird Immutable, also ohne Setter, sondern geben
    //ein geklontes Object zurück
    public function withErros(array $errors): self
    {
        //Immutable
        $clone = clone $this;
        $clone->errors = $errors;
        return $clone;
    }
}
