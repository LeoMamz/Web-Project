<?php
class Report_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
        $this->load->helper('url_helper');
    }

    // 根据自然人身份证号检查自然人证券账户是否存在
    public function natrual_if_exist($data)
    {
    	//$sql = "SELECT * FROM admin WHERE ID = '" . $data['username'] . "' AND password = '" . $data['password'] . "'";
    	//$query = $this->db->query($sql);
        $query = $this->db->select('*')->from('natural_security_acc')
                                       ->where('identity_num', $data['identity_num'])
                                       ->get();
    	if ($query->num_rows() != 0) 
            return TRUE;
    	else 
            return FALSE;
    }

    // 根据法人注册登记号检查法人证券账户是否存在
     public function corp_if_exist($data)
    {
        //$sql = "SELECT * FROM admin WHERE ID = '" . $data['username'] . "' AND password = '" . $data['password'] . "'";
        //$query = $this->db->query($sql);
        $query = $this->db->select('*')->from('corp_security_acc')
                                       ->where('reg_id', $data['reg_id'])
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

    // 冻结证券账户以及改证券账户下的所有的证券,info包含证券账户类型以及证券帐号
    public function exec_frozen($info)
    {
        if($info['type'] == 'natrual')
            $table_name = 'natural_security_acc';
        else if ($info['type'] == 'corp') 
            $table_name = 'corp_security_acc';

        // 检查是否已经挂失
        $tmp = $this->db->select('*')->from($table_name)
                              ->where('sec_acc', $info['sec_acc'])
                              ->where('if_frozen', 1)
                              ->get();
        if($tmp->num_rows())
            return 'xx';

        // 冻结证券账户
        $this->db->update($table_name, array('if_frozen' => 1 ), array('sec_acc' => $info['sec_acc']));
        $op1 =  $this->db->affected_rows();
            
        
        // 冻结证券账户名下的所有证券
        $this->db->update('stock_info', $data, array('sec_acc' => $info['sec_acc']));
        $op2 = $this->db->affected_rows();

        if($op1 || $op2)    
            return TRUE;
        else 
            return FALSE;
    }
}



