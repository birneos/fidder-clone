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

class PDOUserRepository implements UserRepository
{
    private $created = [];

    /**
     */
    public function __construct(private readonly \PDO $connection)
    {
    }

    public function add(UserEntity $userEntity): bool
    {
        $this->created[] = $userEntity;

        return true;
    }

    /**
     * @return bool
     */
    public function persist(): bool
    {
        $sql = [];
        $insertSQL = 'INSERT INTO t_user(id, username, email, pwdhash, createAt) VALUES (:id, :username, :email, :pwdhash, now()) ';
        $insertData = [];
        /**
         * @var UserEntity $user
         */

        $stmt = $this->connection->prepare($insertSQL);

        foreach ($this->created as $index => $user) {
            $stmt->bindValue(':id', $user->getId(), \PDO::PARAM_STR);
            $stmt->bindValue(':username', $user->getUsername(), \PDO::PARAM_STR);
            $stmt->bindValue(':email', $user->getEmail(), \PDO::PARAM_STR);
            $stmt->bindValue(':pwdhash', $user->getPassword(), \PDO::PARAM_STR);
            $stmt->execute();
        }

        return true;
    }
    /**
     * @return bool
     */
    public function isUserExist(string $username): bool
    {
        $stmt = $this->connection->prepare("SELECT 1 FROM t_user WHERE username = :username");
        $stmt->execute(['username'=>$username]);

        return (bool) $stmt->fetchColumn();
    }

    /**
     * @return bool
     */
    public function isEmailExist(string $email): bool
    {
        $stmt = $this->connection->prepare("SELECT 1 FROM t_user WHERE email = :email");
        $stmt->execute(['email'=>$email]);

        return (bool) $stmt->fetchColumn();
    }
}
