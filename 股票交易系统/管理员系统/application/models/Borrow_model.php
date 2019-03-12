<?php
class Borrow_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
        $this->load->helper('url_helper');
        $this->load->helper('date');
    }

    public function search($data)
    {
        $this->db->where('cno', $data['Cno']);
        return $this->db->select('*')->from('borrow')->get();
    }

    public function borrow($data)
    {
        $this->db->where('bno', $data['Bno']);
        $result = $this->db->select('stock')->from('book')->get();
        // return $result->row()->stock;
        if ($result->row()->stock > 0)
        {
            $this->db->trans_start();

            $this->db->set('bno', $data['Bno']);
            $this->db->set('cno', $data['Cno']);
            $this->db->set('admin_id', $data['Admin_id']);
            $this->db->set('borrow_date', date("Y-m-d H:i:s"));
            $this->db->set('return_date', null);

            $this->db->insert('borrow');

            $_data = array(
                'stock' => (string)((int)$result->row()->stock - 1)
            );
            $this->db->where('bno', $data['Bno']);
            $this->db->update('book', $_data);
            $_result = $this->db->affected_rows();

            $this->db->trans_complete();
            return $_result;
        }
        else
        {
            return 0;
        }
    }

    public function return_book($data)
    {
        $this->db->where('bno', $data['Bno']);
        $this->db->where('cno', $data['Cno']);
        $result = $this->db->select('*')->from('borrow')->get();

        $this->db->where('bno', $data['Bno']);
        $stock = $this->db->select('stock')->from('book')->get();
        if ($result->num_rows() > 0)
        {
            $this->db->trans_start();

            $_result = array(
                'return_date' => date("Y-m-d H:i:s")
            );
            $this->db->where('bno', $data['Bno']);
            $this->db->update('borrow', $_result);

            $_stock = array(
                'stock' => (string)((int)$stock->row()->stock + 1)
            );
            $this->db->where('bno', $data['Bno']);
            $this->db->update('book', $_stock);

            $Result = $this->db->affected_rows();

            $this->db->trans_complete();
            return $Result;
        }
    }

    // public function search($data)
    // {
    //     $this->db->where('bno', $data['Bno']);
    //     return $this->db->select('*')->from('book')->get();
    // }

    // public function insert($data)
    // {
    //     $this->db->set('bno', $data['Bno']);
    //     $this->db->set('category', $data['Category']);
    //     $this->db->set('title', $data['Title']);
    //     $this->db->set('press', $data['Press']);
    //     $this->db->set('year', $data['Year']);
    //     $this->db->set('author', $data['Author']);
    //     $this->db->set('stock', $data['Num']);
    //     $this->db->set('price', $data['Price']);
    //     $this->db->set('total', $data['Num']);

    //     $this->db->insert('book');
        
    //     return $this->db->affected_rows();
    // }

    // public function update($data, $result)
    // {
    //     $now_total = $result->total + $data['Num'];
    //     $now_stock = $result->stock + $data['Num'];
    //     $_data = array(
    //         'total' => $now_total,
    //         'stock' => $now_stock
    //     );

    //     $this->db->where('bno', $data['Bno']);
    //     $this->db->update('book', $_data);

    //     return $this->db->affected_rows();
    // }
}