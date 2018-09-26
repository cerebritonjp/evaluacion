<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Numericality;

class ProductsForm extends Form
{
    /**
     * Initialize the products form
     */
    public function initialize($entity = null, $options = array())
    {
        if (!isset($options['edit'])) {
            $element = new Text("id");
            $this->add($element->setLabel("Id"));
        } else {
            $this->add(new Hidden("id"));
        }

        $name = new Text("name");
        $name->setLabel("Nombre Actor");
        $name->setFilters(['striptags', 'string']);
        $name->addValidators([
            new PresenceOf([
                'message' => 'Nombre de Actor requerido'
            ])
        ]);
        $this->add($name);

        $type = new Select('product_types_id', ProductTypes::find(), [
            'using'      => ['id', 'name'],
            'useEmpty'   => true,
            'emptyText'  => '...',
            'emptyValue' => ''
        ]);
        $type->setLabel('Tipo de Actor');
        $this->add($type);

      
        
    }
}
