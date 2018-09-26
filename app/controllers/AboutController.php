<?php

class AboutController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Acerca de Nosotros');
        parent::initialize();
    }

    public function indexAction()
    {
    }
}
