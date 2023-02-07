<?php

namespace PhpFidder\Core\Components\Registration\Event;

use PhpFidder\Core\Entity\UserEntity;

class RegistrationSuccessEvent
{
    public function __construct(UserEntity $user)
    {
    }
}
