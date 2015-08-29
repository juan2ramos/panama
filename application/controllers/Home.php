<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
    private $messageError;

    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library(array('session', 'form_validation'));
        $this->load->model('code_model');
        $this->load->model('users_model');
    }

    public function index()
    {

        $this->load->view('layouts/default', array('title' => 'Formulario', 'view' => 'form/index'));
    }


    public function post()
    {

        $_POST['code'] = $this->input->post('code-1') . '-' . $this->input->post('code-2') . '-' .$this->input->post('code-3')  ;
        $val = $this->validate();

        if ($val) {

            $this->insertForm($this->input->post());
            echo json_encode(array('success' => true));

        } else {
            if($val){
                echo json_encode(array('success' => true));

            }else{
                echo json_encode(array('success' => false,'errors' => $this->messageError));
            }


        }

    }

    private function insertForm($post)
    {
        $college = (isset($post['college']))?$post['college']:'';
        $workplaces = (isset($post['workplace']))?$post['workplace']:'';
        $user = array(
            'names' => $post['names'],
            'birthday' => $post['birthday'],
            'email' => $post['email'],
            'identification' => $post['identification'],
            'phone' => $post['phone'],
            'address' => $post['address'],
            'college' => $college,
            'workplace' => $workplaces,
        );
        $idUser = $this->users_model->addUser($user);
        $code = [
            'status' => 1,
            'id_user'=> $idUser
        ];
        $this->code_model->updateCode($code, $post['code']);
    }

    private function validate()
    {
        if ($this->input->post()) {

            $config = array(

                array('field' => 'names', 'label' => 'names', 'rules' => 'required'),
                array('field' => 'birthday', 'label' => 'birthday', 'rules' => 'required'),
                array('field' => 'identification', 'label' => 'identification', 'rules' => 'required|is_unique[users.identification]'),
                array('field' => 'phone', 'label' => 'phone', 'rules' => 'required'),
                array('field' => 'email', 'label' => 'email', 'rules' => 'required|valid_email|is_unique[users.email]'),
                array('field' => 'code', 'label' => 'code-1', 'rules' => 'required|callback_validateCode'),
                array('field' => 'address', 'label' => 'address', 'rules' => 'required'),

            );

            $this->form_validation->set_message('required', '%s');
            $this->form_validation->set_message('valid_email', '%s');
            $this->form_validation->set_message('is_unique', 'is_unique++%s');
            $this->form_validation->set_message('validateCode','validateCode++%s');


            $this->form_validation->set_rules($config);

            if (!$this->form_validation->run()) {

                $this->messageError = validation_errors(' ', '**');
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
    function validateCode($str)
    {
        return (!empty($this->code_model->getCodeWhere($str)))?TRUE:FALSE;

    }
}
