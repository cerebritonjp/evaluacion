<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;

class CompaniesForm extends Form
{
    /**
     * Initialize the companies form
     */
    public function initialize($entity = null, $options = [])
    {
        if (!isset($options['edit'])) {
            $element = new Text("id");
            $this->add($element->setLabel("Id"));
        } else {
            $this->add(new Hidden("id"));
        }

        $nom_Pelicula = new Text("nom_Pelicula");
        $nom_Pelicula->setLabel("Nombre");
        $nom_Pelicula->setFilters(['striptags', 'string']);
        $nom_Pelicula->addValidators([
            new PresenceOf([
                'message' => 'El nombre es requerido'
            ])
        ]);
        $this->add($nom_Pelicula);

        $des_Pelicula = new Text("des_Pelicula");
        $des_Pelicula->setLabel("Descripción");
        $des_Pelicula->setFilters(['striptags', 'string']);
        $des_Pelicula->addValidators([
            new PresenceOf([
                'message' => 'Descripcion de pelicula es requerido'
            ])
        ]);
        $this->add($des_Pelicula);

    }
}
