<?php
declare(strict_types=1);

namespace PhpFidder\Core\Entity;

class UserEntity{
    public function __construct(
        private string  $username,
        private string  $email,
        private string  $password){    
        }

}