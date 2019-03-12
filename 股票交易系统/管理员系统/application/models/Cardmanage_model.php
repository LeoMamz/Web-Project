<?php
class Cardmanage_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
        $this->load->helper('url_helper');
    }

    public function search_card()
    {
        return $this->db->select('*')->from('card')->get();
    }

    public function insert_card($data)
    {
        $this->db->set('cno', $data['Cno']);
        $this->db->set('name', $data['Name']);
        $this->db->set('department', $data['Department']);
        $this->db->set('type', $data['Type']);

        $this->db->insert('card');
        return $this->db->affected_rows();
    }

    public function delete_card($data)
    {
        $this->db->where('cno', $data['Cno']);

        $this->db->delete('card');
        return $this->db->affected_rows();
    }

}