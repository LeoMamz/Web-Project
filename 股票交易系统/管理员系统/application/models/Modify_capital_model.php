<?php
class Modify_capital_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
		$this->load->helper('url_helper');
	}

	public function _check($data)
	{
		//$sql = "SELECT * FROM admin WHERE ID = '" . $data['username'] . "' AND password = '" . $data['password'] . "'";
		//$query = $this->db->query($sql);
		$query = $this->db->select('*')->from('capital_acc')
			->where('cap_acc', $data['cap_acc'])//security_id
			->get();
		if ($query->num_rows() != 0) return TRUE;
		else return FALSE;
	}


	public function capital_info($data){
		$query=$this->db->select('*')->from('capital_acc')
			->where('cap_acc',$data['cap_acc'])
			->get();
		if($query->num_rows()>0){
			$result=$query->result();
			return $result;
		}else{
			return FALSE;
		}
	}

	public function modify_password($data){
		$query=$this->db->select('*')->from('capital_acc')
			->where('cap_acc',$data['cap_acc'])
			->where('cap_pwd',$data['cap_pwd_old'])
			->get();
		if($query->num_rows()>0){
			$this->db->update('capital_acc',array('cap_pwd'=>$data['cap_pwd_new']),array('cap_acc'=>$data['cap_acc']));
			$op1=$this->db->affected_rows();
			if($op1) return TRUE;
			else return FALSE;
		}else
			return FALSE;

	}



}
