<?php

/**
 * Created by PhpStorm.
 * User: juan2ramos
 * Date: 13/08/15
 * Time: 23:43
 */
class Code_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    function getCodes() {
        $query = $this->db->get('codes');
        return $query->result_array();;
    }
    function getCodeWhere($code) {
        $this->db->where('code',$code);
        $this->db->where('status','0');

        $query = $this->db->get('codes');
        return ($query->num_rows() > 0)?true:false;
    }
    function getCode($id) {
        $this->db->where('id',$id);
        $query = $this->db->get('codes');
        return $query->result_array();;

    }

    function updateCode($postData, $code ) {

        $this->db->where('code', $code);
        return $this->db->update('codes', $postData);
    }

    function addCode($postData){
        $this->db->insert('code', $postData);

    }

}