<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;

class Users extends Model
{
    public function validation()
    {
        $validator = new Validation();
        
        $validator->add(
            'email',
            new EmailValidator([
            'message' => 'El email ingresado es inválido'
        ]));
        $validator->add(
            'email',
            new UniquenessValidator([
            'message' => 'El email se encuentra registrado por otro usuario'
        ]));
        $validator->add(
            'username',
            new UniquenessValidator([
            'message' => 'El nombre de usuario ya esta siendo usado'
        ]));
        
        return $this->validate($validator);
    }
}
