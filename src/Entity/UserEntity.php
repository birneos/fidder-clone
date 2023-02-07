<?php

declare(strict_types=1);

namespace PhpFidder\Core\Entity;

class UserEntity
{
    public function __construct(
        private readonly string  $id,
        private readonly string  $username,
        private readonly string  $email,
        private readonly string  $pwdhash,
    ) {
    }


    public function getId()
    {
        return $this->id;
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
        return $this->pwdhash;
    }
}
