<?php

namespace PhpFidder\Core\Registration\Event;
use PhpFidder\Core\Entity\UserEntity;


class RegistrationSuccessEvent{


    public function __construct(UserEntity $user){

    }
}