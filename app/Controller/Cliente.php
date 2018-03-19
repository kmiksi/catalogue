<?php

class Cliente extends Controller
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

    public function add()
    {
        if ($this->requestMethodIs('post')) {
            $success = false;
            $form_data = $this->formData(['nome', 'email', 'telefone']);

            $target_dir = ROOT . 'public/thumbs/';

            $form_data[':foto'] = basename($_FILES['foto']['name']);
            $target_file = $target_dir . $form_data[':foto'];

            // Check if image file is a actual image or fake image
            $isImage = getimagesize($_FILES['foto']['tmp_name']);
            if ($isImage) {
                if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
                    $this->model = new ClienteModel();

                    $success = $this->model->add($form_data);
                    if ($success) {
                        $message = 'SUCCESS!';
                    } else {
                        $message = 'ERROR: Error inserting data, please try again.';
                    }
                } else {
                    $message = 'Fail to save image.';
                }
            } else {
                $message = 'Invalid image.';
            }

            if ($success) {
                $this->redirect('/');
            } else {
                $this->set(compact('message'));
                $this->render('fail');
            }
        }
    }

    public function edit($id)
    {
        $this->model = new ClienteModel();

        if ($this->requestMethodIs('post')) {
            $form_data = $this->formData(['nome', 'email', 'telefone']);

            $success = $this->model->edit($id, $form_data);

            if ($success !== false) {
                $this->redirect('/');
            } else {
                $message = 'ERROR: Error changing data, please try again.';
                $this->set(compact('message'));
                $this->render('fail');
            }
        } else {
            $cliente = $this->model->find($id);

            $this->set(compact('cliente'));
        }
    }

    public function del($id)
    {
        $this->model = new ClienteModel();

        $success = $this->model->delete($id);

        if ($success !== false) {
            $this->redirect('/');
        } else {
            $message = 'ERROR: Error changing data, please try again.';
            $this->set(compact('message'));
            $this->render('fail');
        }
    }

}
