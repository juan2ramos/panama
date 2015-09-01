<?php

/**
 * Created by PhpStorm.
 * User: juan2ramos
 * Date: 13/08/15
 * Time: 23:43
 */
class Users_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    function getUsers() {
        $query = $this->db->get('users');
        return $query->result_array();;
    }
    function getUsersWhere($id) {
        $this->db->where('id_team',$id);
        $query = $this->db->get('users');
        return $query->result_array();;
    }
    function getUser($id) {
        $this->db->where('id',$id);
        $query = $this->db->get('users');
        return $query->result_array();;
    }

    function addUser($postData){

        $this->db->insert('users', $postData);

        return $this->db->insert_id();



    }
    function updateUser($postData, $id ) {

        $this->db->where('id', $id);
        return $this->db->update('users', $postData);
    }
    function userTeam(){
        $query = $this->db->query("SELECT * FROM team INNER JOIN users ON team.id = users.id_team");
        return $query->result_array();
    }
}