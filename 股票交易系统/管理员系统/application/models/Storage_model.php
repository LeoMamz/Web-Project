<?php
class Storage_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
        $this->load->helper('url_helper');
    }

    public function search($data)
    {
        $this->db->where('bno', $data['Bno']);
        return $this->db->select('*')->from('book')->get();
    }

    public function insert($data)
    {
        $this->db->set('bno', $data['Bno']);
        $this->db->set('category', $data['Category']);
        $this->db->set('title', $data['Title']);
        $this->db->set('press', $data['Press']);
        $this->db->set('year', $data['Year']);
        $this->db->set('author', $data['Author']);
        $this->db->set('stock', $data['Num']);
        $this->db->set('price', $data['Price']);
        $this->db->set('total', $data['Num']);

        $this->db->insert('book');
        
        return $this->db->affected_rows();
    }

    public function update($data, $result)
    {
        $now_total = $result->total + $data['Num'];
        $now_stock = $result->stock + $data['Num'];
        $_data = array(
            'total' => $now_total,
            'stock' => $now_stock
        );

        $this->db->where('bno', $data['Bno']);
        $this->db->update('book', $_data);

        return $this->db->affected_rows();
    }
}