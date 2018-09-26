<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;

class RegisterForm extends Form
{
    public function initialize($entity = null, $options = null)
    {
        // Name
        $name = new Text('name');
        $name->setLabel('Nombre completo');
        $name->setFilters(['striptags', 'string']);
        $name->addValidators([
            new PresenceOf([
                'message' => 'El nombre es un campo requerido'
            ])
        ]);
        $this->add($name);

        // Name
        $name = new Text('username');
        $name->setLabel('Usuario');
        $name->setFilters(['alpha']);
        $name->addValidators([
            new PresenceOf([
                'message' => 'Ingrese el nombre de usuario'
            ])
        ]);
        $this->add($name);

        // Email
        $email = new Text('email');
        $email->setLabel('E-Mail');
        $email->setFilters('email');
        $email->addValidators([
            new PresenceOf([
                'message' => 'E-mail es un campo requerido'
            ]),
            new Email([
                'message' => 'E-mail no es válido'
            ])
        ]);
        $this->add($email);

        // Password
        $password = new Password('password');
        $password->setLabel('Clave');
        $password->addValidators([
            new PresenceOf([
                'message' => 'Ingrese la clave'
            ])
        ]);
        $this->add($password);

        // Confirm Password
        $repeatPassword = new Password('repeatPassword');
        $repeatPassword->setLabel('Repita la clave');
        $repeatPassword->addValidators([
            new PresenceOf([
                'message' => 'La clave ingresada no coincide'
            ])
        ]);
        $this->add($repeatPassword);
    }
}
