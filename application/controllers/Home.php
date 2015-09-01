<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
    private $messageError;
    private $idTeam;

    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library(array('session', 'form_validation'));
        $this->load->model('code_model');
        $this->load->model('users_model');
        $this->load->model('team_model');
    }

    public function index()
    {

        $this->load->view('layouts/default', array('title' => 'Formulario', 'view' => 'form/index'));
    }


    public function post()
    {

        $_POST['code'] = $this->input->post('code-1') . '-' . $this->input->post('code-2') . '-' . $this->input->post('code-3');
        $val = $this->validate();

        if ($val) {
            $this->insertForm($this->input->post());
            echo json_encode(array('success' => true));

        } else {
            if ($val) {

                echo json_encode(array('success' => true));

            } else {
                echo json_encode(array('success' => false, 'errors' => $this->messageError));
            }


        }

    }

    private function insertForm($post)
    {
        $college = (isset($post['college'])) ? $post['college'] : '';
        $workplaces = (isset($post['workplace'])) ? $post['workplace'] : '';


        $college2 = (isset($post['college-2'])) ? $post['college-2'] : '';
        $workplaces2 = (isset($post['workplace-2'])) ? $post['workplace-2'] : '';

        $college3 = (isset($post['college-3'])) ? $post['college-3'] : '';
        $workplaces3 = (isset($post['workplace-3'])) ? $post['workplace-3'] : '';

        $college4 = (isset($post['college-4'])) ? $post['college-4'] : '';
        $workplaces4 = (isset($post['workplace-4'])) ? $post['workplace-4'] : '';

        $college5 = (isset($post['college-5'])) ? $post['college-5'] : '';
        $workplaces5 = (isset($post['workplace-5'])) ? $post['workplace-5'] : '';

        $countTeams = $this->team_model->getTeamRows();
        $countTeams = ($countTeams <= 128) ? ($countTeams == 0) ? 0 : $countTeams  : $countTeams - 128 ;
        $idDates = ceil($countTeams / 32);


        $team = array(

            'name-team' => $post['name-team'],
            'id_date' => $idDates,
        );

        $idTeam = $this->team_model->addTeam($team);


        $user = array(
            'names' => $post['names'],
            'birthday' => $post['birthday'],
            'email' => $post['email'],
            'identification' => $post['identification'],
            'phone' => $post['phone'],
            'address' => $post['address'],
            'college' => $college,
            'workplace' => $workplaces,
            'captain' => ($post['captain'] == 1) ? 1 : 0,
            'id_team' => $idTeam
        );
        $user2 = array(
            'names' => $post['names-2'],
            'birthday' => $post['birthday-2'],
            'email' => $post['email-2'],
            'identification' => $post['identification-2'],
            'phone' => $post['phone-2'],
            'address' => $post['address-2'],
            'college' => $college2,
            'workplace' => $workplaces2,
            'captain' => ($post['captain'] == 2) ? 1 : 0,
            'id_team' => $idTeam
        );
        $user3 = array(
            'names' => $post['names-3'],
            'birthday' => $post['birthday-3'],
            'email' => $post['email-3'],
            'identification' => $post['identification-3'],
            'phone' => $post['phone-3'],
            'address' => $post['address-3'],
            'college' => $college3,
            'workplace' => $workplaces3,
            'captain' => ($post['captain'] == 3) ? 1 : 0,
            'id_team' => $idTeam
        );
        $user4 = array(
            'names' => $post['names-4'],
            'birthday' => $post['birthday-4'],
            'email' => $post['email-4'],
            'identification' => $post['identification-4'],
            'phone' => $post['phone-4'],
            'address' => $post['address-4'],
            'college' => $college4,
            'workplace' => $workplaces4,
            'captain' => ($post['captain'] == 4) ? 1 : 0,
            'id_team' => $idTeam
        );
        $user5 = array(
            'names' => $post['names-5'],
            'birthday' => $post['birthday-5'],
            'email' => $post['email-5'],
            'identification' => $post['identification-5'],
            'phone' => $post['phone-5'],
            'address' => $post['address-5'],
            'college' => $college5,
            'workplace' => $workplaces5,
            'captain' => ($post['captain'] == 5) ? 1 : 0,
            'id_team' => $idTeam
        );

        $this->users_model->addUser($user);
        $this->users_model->addUser($user2);
        $this->users_model->addUser($user3);
        $this->users_model->addUser($user4);
        $this->users_model->addUser($user5);

        $code = array(
            'status' => 1,
            'id_team' => $idTeam
        );
        $this->idTeam = $idTeam;
        $this->code_model->updateCode($code, $post['code']);
    }

    private function validate()
    {
        if ($this->input->post()) {

            $config = array(
                array('field' => 'code', 'label' => 'code-1', 'rules' => 'required|callback_validateCode'),
                array('field' => 'name-team', 'label' => 'name-team', 'rules' => 'required|is_unique[teams.name-team]'),
                array('field' => 'captain', 'label' => 'captain', 'rules' => 'required'),

                array('field' => 'names', 'label' => 'names', 'rules' => 'required'),
                array('field' => 'birthday', 'label' => 'birthday', 'rules' => 'required'),
                array('field' => 'identification', 'label' => 'identification', 'rules' => 'required|is_unique[users.identification]'),
                array('field' => 'phone', 'label' => 'phone', 'rules' => 'required'),
                array('field' => 'email', 'label' => 'email', 'rules' => 'required|valid_email|is_unique[users.email]'),
                array('field' => 'address', 'label' => 'address', 'rules' => 'required'),

                array('field' => 'names-2', 'label' => 'names-2', 'rules' => 'required'),
                array('field' => 'birthday-2', 'label' => 'birthday-2', 'rules' => 'required'),
                array('field' => 'identification-2', 'label' => 'identification-2', 'rules' => 'required|is_unique[users.identification]'),
                array('field' => 'phone-2', 'label' => 'phone-2', 'rules' => 'required'),
                array('field' => 'email-2', 'label' => 'email-2', 'rules' => 'required|valid_email|is_unique[users.email]'),
                array('field' => 'address-2', 'label' => 'address-2', 'rules' => 'required'),

                array('field' => 'names-3', 'label' => 'names-3', 'rules' => 'required'),
                array('field' => 'birthday-3', 'label' => 'birthday-3', 'rules' => 'required'),
                array('field' => 'identification-3', 'label' => 'identification-3', 'rules' => 'required|is_unique[users.identification]'),
                array('field' => 'phone-3', 'label' => 'phone-3', 'rules' => 'required'),
                array('field' => 'email-3', 'label' => 'email-3', 'rules' => 'required|valid_email|is_unique[users.email]'),
                array('field' => 'address-3', 'label' => 'address-3', 'rules' => 'required'),

                array('field' => 'names-4', 'label' => 'names-4', 'rules' => 'required'),
                array('field' => 'birthday-4', 'label' => 'birthday-4', 'rules' => 'required'),
                array('field' => 'identification-4', 'label' => 'identification-4', 'rules' => 'required|is_unique[users.identification]'),
                array('field' => 'phone-4', 'label' => 'phone-4', 'rules' => 'required'),
                array('field' => 'email-4', 'label' => 'email-4', 'rules' => 'required|valid_email|is_unique[users.email]'),
                array('field' => 'address-4', 'label' => 'address-4', 'rules' => 'required'),

                array('field' => 'names-5', 'label' => 'names-5', 'rules' => 'required'),
                array('field' => 'birthday-5', 'label' => 'birthday-5', 'rules' => 'required'),
                array('field' => 'identification-5', 'label-5' => 'identification', 'rules' => 'required|is_unique[users.identification]'),
                array('field' => 'phone-5', 'label' => 'phone-5', 'rules' => 'required'),
                array('field' => 'email-5', 'label' => 'email-5', 'rules' => 'required|valid_email|is_unique[users.email]'),
                array('field' => 'address-5', 'label' => 'address-5', 'rules' => 'required'),


            );


            $this->form_validation->set_message('required', '%s');
            $this->form_validation->set_message('valid_email', '%s');
            $this->form_validation->set_message('is_unique', 'is_unique++%s');
            $this->form_validation->set_message('validateCode', 'validateCode++%s');


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

        return $this->code_model->getCodeWhere($str);
    }
}