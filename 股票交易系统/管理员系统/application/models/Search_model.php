<?php
class Search_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
        $this->load->helper('url_helper');
    }

    public function search($data)
    {
        if (!empty($data['Years'])){
            $Years = explode('*', $data['Years']);
            foreach ($Years as $value) {
                $_Years = explode('-', $value, 2);
                $this->db->where('year >=', $_Years[0]);
                $this->db->where('year <=', $_Years[1]);
            }  
        }

        if (!empty($data['Price'])){
            $Price = explode('*', $data['Price']);
            foreach ($Price as $value) {
                $_Price = explode('-', $value, 2);
                $this->db->where('price >=', $_Price[0]);
                $this->db->where('price <=', $_Price[1]);
            }
        }
        
        if (!empty($data['Category'])){
            $Category = explode('*', $data['Category']);
            foreach ($Category as $value) {
                $this->db->like('category', $value);
            }
        }

        if (!empty($data['Title'])){
            $Title = explode('*', $data['Title']);
            foreach ($Title as $value) {
                $this->db->like('title', $value);
            }
        }

        if (!empty($data['Press'])){
            $Press = explode('*', $data['Press']);
            foreach ($Press as $value) {
                $this->db->like('press', $value);
            }
        }

        if (!empty($data['Author'])){
            $Author = explode('*', $data['Author']);
            foreach ($Author as $value) {
                $this->db->like('author', $value);
            }
        }

        return $this->db->select('*')->from('book')->get();
    }

    function search_all()
    {
        return $this->db->select('*')->from('book')->get();
    }
}