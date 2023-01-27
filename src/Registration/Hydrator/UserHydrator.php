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

final class UserHydrator {

    public function hydrate(array $data): UserEntity{
        return new UserEntity(
            $data['username'],
            $data['email'],
            $data['password']
        );
    }

}