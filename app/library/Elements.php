<?php

use Phalcon\Mvc\User\Component;

/**
 * Elements
 *
 * Helps to build UI elements for the application
 */
class Elements extends Component
{
    private $_headerMenu = [
        'navbar-left' => [
            'index' => [
                'caption' => 'Inicio',
                'action' => 'index'
            ],
            'invoices' => [
                'caption' => 'Películas',
                'action' => 'index'
            ],
            'about' => [
                'caption' => 'Acerca de Nosotros',
                'action' => 'index'
            ],
            'contact' => [
                'caption' => 'Contactanos',
                'action' => 'index'
            ],
        ],
        'navbar-right' => [
            'session' => [
                'caption' => 'Iniciar sesión / Registrarse',
                'action' => 'index'
            ],
        ]
    ];

    private $_tabs = [
        'Películas' => [
            'controller' => 'invoices',
            'action' => 'index',
            'any' => true
        ],
        'Directores' => [
            'controller' => 'companies',
            'action' => 'index',
            'any' => true
        ],
        'Actores' => [
            'controller' => 'products',
            'action' => 'index',
            'any' => true
        ],
        'Tipos de Actores' => [
            'controller' => 'producttypes',
            'action' => 'index',
            'any' => true
        ],
        'Tu perfil' => [
            'controller' => 'invoices',
            'action' => 'profile',
            'any' => false
        ]
    ];

    /**
     * Builds header menu with left and right items
     *
     * @return string
     */
    public function getMenu()
    {

        $auth = $this->session->get('auth');
        if ($auth) {
            $this->_headerMenu['navbar-right']['session'] = [
                'caption' => 'Cerrar sesión',
                'action' => 'end'
            ];
        } else {
            unset($this->_headerMenu['navbar-left']['invoices']);
        }

        $controllerName = $this->view->getControllerName();
        foreach ($this->_headerMenu as $position => $menu) {
            echo '<div class="nav-collapse">';
            echo '<ul class="nav navbar-nav ', $position, '">';
            foreach ($menu as $controller => $option) {
                if ($controllerName == $controller) {
                    echo '<li class="active">';
                } else {
                    echo '<li>';
                }
                echo $this->tag->linkTo($controller . '/' . $option['action'], $option['caption']);
                echo '</li>';
            }
            echo '</ul>';
            echo '</div>';
        }

    }

    /**
     * Returns menu tabs
     */
    public function getTabs()
    {
        $controllerName = $this->view->getControllerName();
        $actionName = $this->view->getActionName();
        echo '<ul class="nav nav-tabs">';
        foreach ($this->_tabs as $caption => $option) {
            if ($option['controller'] == $controllerName && ($option['action'] == $actionName || $option['any'])) {
                echo '<li class="active">';
            } else {
                echo '<li>';
            }
            echo $this->tag->linkTo($option['controller'] . '/' . $option['action'], $caption), '</li>';
        }
        echo '</ul>';
    }
}
