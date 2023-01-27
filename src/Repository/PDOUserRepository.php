<?php
/**
 * We use the repository pattern, an interface so we can
 * create concrete classes
 * 
 * PDOUserRepository (PDO DB) Safe Data to DB
 * FILEUserRepository (FILESYSTEM TO SAFE USERDATE) usw.
 */
declare(strict_types=1);

namespace PhpFidder\Core\Repository;
use PhpFidder\Core\Entity\UserEntity;
use PhpFidder\Core\Repository\UserRepository;

class PDOUserRepository implements UserRepository{
    /**
     */
    public function __construct() {
    }
	
	public function add(UserEntity $userEntity): bool {

        return true;
	}
	
	/**
	 * @return bool
	 */
	public function persist(): bool {

        return true;
	}
}