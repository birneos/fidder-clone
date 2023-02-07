<?php

/**
 *
 * Zum validieren von Daten, die zur Registrierung des Users verwendet werden
 * es wird nur geprüft, ob die Daten valide sind bevor diese weiter verarbeitet
 * werden
 */
declare(strict_types=1);

namespace PhpFidder\Core\Components\Registration\Validator;

use PhpFidder\Core\Components\Registration\Request\RegisterRequest;

class RegisterValidator
{
    private array $errors = [];



    public function isValid(
        RegisterRequest $registerRequest,
        bool $isUserExist,
        bool $isEmailExist
    ) {
        if (mb_strlen($registerRequest->getUsername()) === 0) {
            $this->errors[] = "Username is empty";
        }
        if (mb_strlen($registerRequest->getUsername()) <= 3) {
            $this->errors[] = "Username too short";
        }

        if ($isUserExist) {
            $this->errors[] = "Username already exist";
        }

        if (mb_strlen($registerRequest->getPassword()) === 0) {
            $this->errors[] = "password is empty";
        }
        if (mb_strlen($registerRequest->getPassword()) <= 8) {
            $this->errors[] = "password too short";
        }

        if (filter_var($registerRequest->getEmail(), FILTER_VALIDATE_EMAIL) === false) {
            $this->errors[] = "Email is invalid";
        }

        if ($isEmailExist) {
            $this->errors[] = "Email already exist";
        }

        if (htmlspecialchars($registerRequest->getPassword(), ENT_COMPAT) !== htmlspecialchars($registerRequest->getPasswordRepeat(), ENT_COMPAT)) {
            $this->errors[] = "password doesnt match ";
        }

        return count($this->errors) === 0;
    }


    public static function check(mixed $value)
    {
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
