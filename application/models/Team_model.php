<?php

/**
 * Created by PhpStorm.
 * User: juan2ramos
 * Date: 13/08/15
 * Time: 23:43
 */
class Team_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    function getTeams() {
        $query = $this->db->get('teams');
        return $query->result_array();;
    }
    function getTeamRows(){

        $query = $this->db->get('teams');
        return $query->num_rows() ;
    }
    function getTeamWhere($code) {
        $this->db->where('teams',$code);
        $this->db->where('status','0');

        $query = $this->db->get('teams');
        return ($query->num_rows() > 0)?true:false;
    }
    function getTeam($id) {
        $this->db->where('id',$id);
        $query = $this->db->get('teams');
        return $query->result_array();;

    }

    function updateTeam($postData, $code ) {

        $this->db->where('teams', $code);
        return $this->db->update('teams', $postData);
    }

    function addTeam($postData){
        $this->db->insert('teams', $postData);

        return $this->db->insert_id();

    }

}