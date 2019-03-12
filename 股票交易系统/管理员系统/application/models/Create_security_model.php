<?php
class Create_security_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
        $this->load->helper('url_helper');
    }

    public function natural_if_exist($data)
    {
    	//$sql = "SELECT * FROM admin WHERE ID = '" . $data['username'] . "' AND password = '" . $data['password'] . "'";
    	//$query = $this->db->query($sql);
        $query = $this->db->select('*')->from('natural_security_acc')
                                       ->where('identity_num', $data['identity_num'])
                                       ->get();
            
    	if ($query->num_rows() != 0)      // 如果表中已有该身份证号
            return TRUE;      
    	else 
            return FALSE;
    }



    public function corp_if_exist($data)
    {
        //$sql = "SELECT * FROM admin WHERE ID = '" . $data['username'] . "' AND password = '" . $data['password'] . "'";
        //$query = $this->db->query($sql);
        $query = $this->db->select('*')->from('legal_security_acc')
                                       ->where('reg_id', $data['reg_id'])
                                       ->where('license', $data['license'])
                                       ->get();

        if ($query->num_rows() != 0)    // 如果表中已有该注册号和营业执照
            return TRUE;       
        else 
            return FALSE;
    }

    public function get_num()
    {
        $result = $this->db->select('*')->from('card')->get();
        return $result->num_rows();
    }

    public function create_natural_security_acc($data){
        $pwd = $data['identity_num'];
        $agent_id = "";

        $pwd = substr($pwd,strlen($pwd)-6);
        if($data['if_agency'] == "1")
            $agent_id = $data['agent_id'];
       
        $info = array(
            'sec_pwd' => $pwd,        
            'name' => $data['name'],
            'gender' => $data['gender'],
            'identity_num' => $data['identity_num'],
            'address' => $data['address'],
            'occupation' => $data['occupation'],
            'education' => $data['education'],
            'company' => $data['company'],
            'tel' => $data['tel'],
            'if_agency' => $data['if_agency'],
            'agent_id' => $agent_id,
        );
        $this->db->insert('natural_security_acc',$info);
        $op = $this->db->affected_rows();
        if($op != 0) 
            return TRUE;
        else 
            return FALSE;
    }

    public function create_corp_security_acc($data)
    {
        $pwd = $data['corp_rep_id'];
        $pwd = substr($pwd,strlen($pwd)-6);
       
        $info = array(
            'sec_pwd' => $pwd,
            'corp_name' => $data['corp_name'],
            'reg_id' => $data['reg_id'],
            'license' => $data['license'],
            'corp_tel' => $data['corp_tel'],
            'corp_addr' => $data['corp_address'],
            'corp_rep_name' => $data['corp_rep_name'],
            'corp_rep_id' => $data['corp_rep_id'],
            'auth_name' => $data['auth_name'],
            'auth_id' => $data['auth_id'],
            'auth_tel' => $data['auth_tel'],
            'auth_addr' => $data['auth_addr'],
        );
        $this->db->insert('legal_security_acc',$info);
        $op = $this->db->affected_rows();
        if($op != 0) 
            return TRUE;
        else 
            return FALSE;
    }

    // 返回要回显的信息
    public function get_info($info)
    {
        $result = $this->db->select('*')->from($info['table_name'])
                                        ->where($info['attr_name'], $info['attr_val'])
                                        ->get();
        return $result->result();
    }
}