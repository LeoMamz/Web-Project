<?php
class Trade_model extends CI_Model {

	public function __construct()
    {
        $this->load->database();
        $this->load->helper('url_helper');
    }

    public function update_stock_sell($data)
    {
    	$this->db->set('current_price',$data['price']);
    	$this->db->set('stock_num',$data['sell_stock_num']);
        $this->db->set('total_cost',$data['sell_total_cost']);
        $this->db->where('stock_name',$data['stock_name']);
        $this->db->where('sec_acc',$data['sell_id']);
        $this->db->update('stock_info');
    	if($this->db->affected_rows() > 0) return TRUE;
        else return FALSE;
    }

    public function update_stock_buy($data)
    {
    	$this->db->set('current_price',$data['price']);
    	$this->db->set('stock_num',$data['buy_stock_num']);
        $this->db->set('total_cost',$data['buy_total_cost']);
        $this->db->where('stock_name',$data['stock_name']);
        $this->db->where('sec_acc',$data['buy_id']);
        $this->db->update('stock_info');
    	if($this->db->affected_rows() > 0) return TRUE;
        else return FALSE;
    }

}