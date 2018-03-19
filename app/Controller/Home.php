<?php

class Home extends Controller
{

    public function index()
    {
        $this->page(1);
    }

    public function page($page = 1)
    {
        $this->model = new ClienteModel();
        $clientes = $this->model->paginate($page);
        $pagination = $this->model->pagination;

        $this->set(compact('clientes', 'pagination'));
    }

}
