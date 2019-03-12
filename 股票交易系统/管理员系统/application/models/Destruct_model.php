<?php
class Destruct_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
        $this->load->helper('url_helper');
    }

    // 根据自然人身份证号检查自然人证券账户是否存在
    public function natural_if_exist($info)
    {
    	//$sql = "SELECT * FROM admin WHERE ID = '" . $info['username'] . "' AND password = '" . $info['password'] . "'";
    	//$query = $this->db->query($sql);
        $query = $this->db->select('*')->from('natural_security_acc')
                                       ->where('identity_num', $info['identity_num'])
                                       ->where('sec_acc', $info['sec_acc'] )
                                       ->get();
    	if ($query->num_rows() != 0) 
            return TRUE;
    	else 
            return FALSE;
    }

    // 根据法人注册登记号检查法人证券账户是否存在
     public function corp_if_exist($info)
    {
        //$sql = "SELECT * FROM admin WHERE ID = '" . $info['username'] . "' AND password = '" . $info['password'] . "'";
        //$query = $this->db->query($sql);
        $query = $this->db->select('*')->from('corp_security_acc')
                                       ->where('reg_id', $info['reg_id'])
                                       ->where('sec_acc', $info['sec_acc'] )
                                       ->get();
        if ($query->num_rows() != 0) 
            return TRUE;
        else 
            return FALSE;
    }


    // 返回要回显的信息
    public function get_info($info)
    {
        $re = $this->db->select('*')->from($info['table_name'])
                                    ->where($info['attr_name'], $info['attr_val'])
                                    ->get();
        return $re->result();
    }

    // 判断证券账户名下的股票是否已经全部卖出
    public function if_sold_out($sec_acc)
    {
        $query = $this->db->select('*')->from($stock_info)
                                       ->where('sec_acc', $sec_acc)
                                       ->get();
        if ($query->num_rows() == 0) 
            return TRUE;
        else 
            return FALSE;
    }

    // 注销证券帐号
    public function exec_destruct($info)
    {
        if($info['type'] == 'natural')
            $this->db->delete('natural_security_acc', array('sec_acc' => $info['sec_acc']));
        else if($info[type] == 'corp')
            $this->db->delete('corp_security_acc', array('sec_acc' => $info['sec_acc']));
        if($this->db->affected_rows())  
            return TRUE;
        else
            return FALSE;      
    }
}



