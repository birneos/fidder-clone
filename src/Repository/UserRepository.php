<?php
/**
 * We use the repository pattern, an interface so we can
 * create concrete classes
 * 
 * PDOUserRepository (PDO DB)
 * FILEUserRepository (FILESYSTEM TO SAFE USERDATE) usw.
 */
declare(strict_types=1);

namespace PhpFidder\Core\Repository;
use PhpFidder\Core\Entity\UserEntity;

interface UserRepository{

    public function add(UserEntity $userEntity): bool;

    public function persist(): bool;
}