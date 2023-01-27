<?php
declare(strict_types=1);

namespace PhpFidder\Core\Registration\Validator;

class RegisterValidator{

    private array $errors = [];

    public function isValid(
        string $username,
        string $email,
        string $password,
        string $passwordRepeat
    ){
        if(mb_strlen($username) === 0){
            $this->errors[] = "Username is empty";
        }
        if(mb_strlen($username) <= 3){
            $this->errors[] = "Username too short";
        }

        if(mb_strlen($password) === 0){
            $this->errors[] = "password is empty";
        }
        if(mb_strlen($password) <= 8){
            $this->errors[] = "password too short";
        }

        if(filter_var($email, FILTER_VALIDATE_EMAIL) === false ){
            $this->errors[] = "Email is invalid";
        }

        if(mb_strlen($username) !== mb_strlen($passwordRepeat)){
            $this->errors[] = "password doesnt match ";
        }
        


        return count($this->errors) === 0;
    }


    public static function check(mixed $value){

        $match = $match(
            
        );

    }

    public function getErrors():array{

        return $this->errors;

    }
}