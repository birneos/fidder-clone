<?php
/**
 * Wir wollen flüssige Daten verfestigen (speichern)
 * 
 * Speichern (verfestigen) von Userdaten, wir speichern die Daten in einer UserEntity (Object), bevor
 * wir diese weiter verwenden
 */
declare(strict_types=1);

namespace PhpFidder\Core\Registration\Hydrator;
use PhpFidder\Core\Entity\UserEntity;
use Ramsey\Uuid\Rfc4122\UuidV7;
use Ramsey\Uuid\Uuid;

final class UserHydrator {

    public function hydrate(array $data): UserEntity{

        $uuid = $data['id'] = Uuid::uuid7()->getBytes();
        $pwd = password_hash($data['password'], PASSWORD_DEFAULT);
        return new UserEntity(
            $data['id']??$uuid,
            $data['username'],
            $data['email'],
            $pwd
        );
    }

}