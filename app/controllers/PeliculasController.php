<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class PeliculasController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Administra las películas');
        parent::initialize();
    }

    /**
     * Shows the index action
     */
    public function indexAction()
    {
        $this->session->conditions = null;
        $this->view->form = new PeliculasForm;
    }

    /**
     * Search companies based on current criteria
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Peliculas", $this->request->getPost());
            $this->persistent->searchParams = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = [];
        if ($this->persistent->searchParams) {
            $parameters =
			 $this->persistent->searchParams;
        }

        $peliculas = Peliculas::find($parameters);
        if (count($peliculas) == 0) {
            $this->flash->notice("No se encuentran películas con los datos buscados");

            return $this->dispatcher->forward(
                [
                    "controller" => "peliculas",
                    "action"     => "index",
                ]
            );
        }

        $paginator = new Paginator([
            "data"  => $peliculas,
            "limit" => 10,
            "page"  => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
        $this->view->peliculas = $peliculas;
    }

    /**
     * Shows the form to create a new company
     */
    public function newAction()
    {
        $this->view->form = new PeliculasForm(null, ['edit' => true]);
    }

    /**
     * Edits a company based on its id
     */
    public function editAction($id)
    {

        if (!$this->request->isPost()) {

            $pelicula = Peliculas::findFirstById($id);
            if (!$pelicula) {
                $this->flash->error("No se encuenta la película");

                return $this->dispatcher->forward(
                    [
                        "controller" => "peliculas",
                        "action"     => "index",
                    ]
                );
            }

            $this->view->form = new PeliculasForm($pelicula, ['edit' => true]);
        }
    }

    /**
     * Creates a new company
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(
                [
                    "controller" => "peliculas",
                    "action"     => "index",
                ]
            );
        }

        $form = new PeliculasForm;
        $pelicula = new Peliculas();

        $data = $this->request->getPost();
        if (!$form->isValid($data, $pelicula)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "peliculas",
                    "action"     => "new",
                ]
            );
        }

        if ($pelicula->save() == false) {
            foreach ($pelicula->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "peliculas",
                    "action"     => "new",
                ]
            );
        }

        $form->clear();

        $this->flash->success("La película ha sido creada con éxito");

        return $this->dispatcher->forward(
            [
                "controller" => "peliculas",
                "action"     => "index",
            ]
        );
    }

    /**
     * Saves current company in screen
     *
     * @param string $id
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(
                [
                    "controller" => "peliculas",
                    "action"     => "index",
                ]
            );
        }

        $id = $this->request->getPost("id", "int");
        $pelicula = Peliculas::findFirstById($id);
        if (!$pelicula) {
            $this->flash->error("La pelicula no existe");

            return $this->dispatcher->forward(
                [
                    "controller" => "peliculas",
                    "action"     => "index",
                ]
            );
        }

        $form = new PeliculasForm;

        $data = $this->request->getPost();
        if (!$form->isValid($data, $pelicula)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "peliculas",
                    "action"     => "new",
                ]
            );
        }

        if ($company->save() == false) {
            foreach ($company->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "peliculas",
                    "action"     => "new",
                ]
            );
        }

        $form->clear();

        $this->flash->success("La película ha sido actualizada con éxito");

        return $this->dispatcher->forward(
            [
                "controller" => "peliculas",
                "action"     => "index",
            ]
        );
    }

    /**
     * Deletes a company
     *
     * @param string $id
     */
    public function deleteAction($id)
    {

        $peliculas = Peliculas::findFirstById($id);
        if (!$peliculas) {
            $this->flash->error("La película no existe");

            return $this->dispatcher->forward(
                [
                    "controller" => "peliculas",
                    "action"     => "index",
                ]
            );
        }

        if (!$peliculas->delete()) {
            foreach ($peliculas->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "peliculas",
                    "action"     => "search",
                ]
            );
        }

        $this->flash->success("Peícula borrada con éxito");

        return $this->dispatcher->forward(
            [
                "controller" => "peliculas",
                "action"     => "index",
            ]
        );
    }
}
