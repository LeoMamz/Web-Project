<?php
class Reapply_model extends CI_Model {

    public function __construct()
    {
        $this->load->old_accbase();
        $this->load->helper('url_helper');
    }

    // 根据自然人身份证号检查自然人证券账户是否存在
    public function natrual_if_exist($old_acc)
    {
    	//$sql = "SELECT * FROM admin WHERE ID = '" . $old_acc['username'] . "' AND password = '" . $old_acc['password'] . "'";
    	//$query = $this->db->query($sql);
        $query = $this->db->select('*')->from('natrual_security_acc')
                                       ->where('identity_num', $old_acc['identity_num'])
                                       ->get();
    	if ($query->num_rows() != 0) 
            return TRUE;
    	else 
            return FALSE;
    }

    // 根据法人注册登记号检查法人证券账户是否存在
     public function corp_if_exist($old_acc)
    {
        //$sql = "SELECT * FROM admin WHERE ID = '" . $old_acc['username'] . "' AND password = '" . $old_acc['password'] . "'";
        //$query = $this->db->query($sql);
        $query = $this->db->select('*')->from('corp_security_acc')
                                       ->where('reg_id', $old_acc['reg_id'])
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

    // 判断证券账户是否已经挂失,info包含证券账户类型（natrual或者corp）以及证券帐号
    public function if_report($info)
    {
        if($info['type'] == 'natrual')
            $table_name = 'natrucorp_security_acc';
        else if ($info['type'] == 'corp') 
            $table_name = 'corp_security_acc';
        query = $this->db->select('*')->from($table_name)
                                       ->where('sec_acc', $info['sec_acc'])
                                       ->where('if_frozen', TRUE)
                                       ->get();
        if ($query->num_rows() != 0) 
        {
            $table = array(
                'table_name' => $table_name,
                'attr_name' => 'sec_acc',
                'attr_val' => $info['sec_acc']
            );
            $result = get_info($table);
            return $result;
        }
        else 
            return FALSE;
    }

    // 补办证券帐号,$old_acc包含旧帐号的全部信息,以及所在的表的名字
    public function exec_reapply($old_acc)
    {
        $this->db->delete($old_acc['table_name'], array('sec_acc' => $old_acc['sec_acc']));

        if($old_acc['table_name'] == natrucorp_security_acc)
        {
            $pwd = $old_acc['identity_num'];
            $pwd = substr($pwd,strlen($pwd)-6);

            $new_acc = array(
                'sec_pwd' => $pwd,,            
                'name' => $old_acc['name'],
                'gender' => $old_acc['gender'],
                'identity_num' => $old_acc['identity_num'],
                'address' => $old_acc['address'],
                'occupation' => $old_acc['occupation'],
                'education' => $old_acc['education'],
                'company' => $old_acc['company'],
                'tel' => $old_acc['tel'],
                'if_agency' => $old_acc['if_agency'],
                'agent_id' => $agent_id,
            );
            $this->db->insert($old_acc['table_name'], $new_acc);
            $op = $this->db->effected_rows();

            if($op) 
            {
                // 获取新账户信息
                $re = $this->db->select('*')->from($old_acc['table_name'])
                                        ->where('identity_num', $new_acc['identity_num'])
                                        ->get();
                $re = $re->result();
                                       
                // 更新stock_info表                       
                $this->db->update('stock_info', array('sec_acc' => $re['sec_acc']), array('sec_acc' => $old_acc['sec_acc']));
                return $re;                        
            }
        }
        else if($old_acc['sec_acc'] == 2)
        {
            $pwd = $old_acc['corp_rep_id'];
            $pwd = substr($pwd,strlen($pwd)-6);
           
            $new_acc = array(
                'sec_pwd' => $pwd,
                'corp_name' => $old_acc['corp_name'],
                'reg_id' => $old_acc['reg_id'],
                'license' => $old_acc['license'],
                'corp_tel' => $old_acc['corp_tel'],
                'corp_addr' => $old_acc['corp_addr'],
                'corp_rep_name' => $old_acc['corp_rep_name'],
                'corp_rep_id' => $old_acc['corp_rep_id'],
                'auth_name' => $old_acc['auth_name'],
                'auth_id' => $old_acc['auth_id'],
                'auth_tel' => $old_acc['auth_tel'],
                'auth_addr' => $old_acc['auth_addr'],
            );
            $this->db->insert($old_acc['table_name'], $new_acc);
            $op = $this->db->effected_rows();

            if($op) 
            {
                // 获取新账户信息
                $re = $this->db->select('*')->from($old_acc['table_name'])
                                        ->where('reg_id', $new_acc['reg_id'])
                                        ->get();
                $re = $re->reset();
                                        
                // 更新stock_info表                       
                $this->db->update('stock_info', array('sec_acc' => $re['sec_acc']), array('sec_acc' => $old_acc['sec_acc']));
                return $re;                        
            }
        }
       
        return FALSE;
    }
}



