<?php
class Client_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
        $this->load->helper('url_helper');
    }

    public function check_account($data)
    {
        $query = $this->db->select('*')->from('capital_acc')
                                       ->where('sec_acc', $data['id'])
                                       ->where('cap_pwd', $data['pwd'])
                                       ->get();
    	if ($query->num_rows() != 0) return TRUE;
    	else return FALSE;
    }

    public function output_reminding($sec_acc)
    {
        $query = $this->db->from('reminding')-> where('sec_acc',$sec_acc['id'])->get();
        $result = array();
        if ($query->num_rows() > 0)
        {
            $i = 0;
            foreach ($query -> result() as $row)
            {
                $stock_code = $row -> stock_code;
                $rising_price = $row -> rising_price;
                $falling_price = $row -> falling_price;
                $daily_gain = $row -> daily_gain;
                $daily_decline = $row -> daily_decline;
                $result[$i] = array($stock_code, $rising_price, $falling_price, $daily_gain, $daily_decline);
                $i ++;
            }
        }
        return $result;
    }

    public function modify_password($data)
    {
        $this->db->set('cap_pwd', $data['newPWD']);
        $this->db->where('sec_acc', $data['id']);
        $this->db->update('capital_acc');
        if($this->db->affected_rows() > 0) return TRUE;
        else return FALSE;
    }

    public function input_reminding($data)
    {
        $this->db->where('sec_acc',$data['sec_acc']);
        $this->db->delete('reminding');
        for ($i = 0;$i < count($data['re']);$i ++)
        {
            $insert = array
            (
                'sec_acc' => $data['sec_acc'],
                'stock_code' => $data['re'][$i][0],
                'rising_price' => $data['re'][$i][1],
                'falling_price' => $data['re'][2],
                'daily_gain' => $data['re'][3],
                'daily_decline' => $data['re'][4]
            );
            $this->db->insert('reminding',$insert);
        }
    }

    public function get_cap($data)
    {
        $query = $this->db->select('*')->from('capital_acc')->where('sec_acc',$data['userID'])->get();
        return $query->row();
    }

    public function get_stock($data)
    {
        $query = $this->db->select('*')->from('stock_info')->where('sec_acc',$data['userID'])->where('stock_code',$data['stockID'])->get();
        return $query->row();
    }

    public function get_stock_sell($data)
    {
        $query = $this->db->select('*')->from('stock_info')->where('sec_acc',$data['sell_id'])->where('stock_code',$data['stockID'])->get();
        return $query->row();
    }

    public function get_stock_buy($data)
    {
        $query = $this->db->select('*')->from('stock_info')->where('sec_acc',$data['buy_id'])->where('stock_code',$data['stockID'])->get();
        return $query->row();
    }

    public function get_stock_all($data)
    {
        $query = $this->db->select('*')->from('stock_info')->where('sec_acc',$data['userID'])->get();
        return $query->result();
    }

}