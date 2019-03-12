<?php
class Login_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
        $this->load->helper('url_helper');
    }

    public function _check($data)
    {
    	//$sql = "SELECT * FROM admin WHERE ID = '" . $data['username'] . "' AND password = '" . $data['password'] . "'";
    	//$query = $this->db->query($sql);
        $query = $this->db->select('*')->from('admin')
                                       ->where('ID', $data['username'])
                                       ->where('password', $data['password'])
                                       ->get();
    	if ($query->num_rows() != 0) return TRUE;
    	else return FALSE;
    }

    public function get_num()
    {
        $result = $this->db->select('*')->from('card')->get();
        return $result->num_rows();
    }
}