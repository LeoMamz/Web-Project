<?php
class Reapply_capital_model extends CI_Model {

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
			->where('sec_acc', $data['sec_acc'])//security_id
			->get();
		if ($query->num_rows() != 0) return TRUE;
		else return FALSE;
	}

//
//	public function security_info($data){
//		$query=$this->db->select('*')->from('natrual_security_acc')
//			->where('sec_acc',$data['sec_acc'])
//			->get();
//		if($query->num_rows()>0){
//			$result=$query->result();
//			return $result;
//		}else{
//			return FALSE;
//		}
//	}
	public function security_info($data){
		$query1=$this->db->select('*')->from('natural_security_acc')
			->where('sec_acc',$data['sec_acc'])
			->get();
		$query2=$this->db->select('*')->from('legal_security_acc')
			->where('sec_acc',$data['sec_acc'])
			->get();
		if($query1->num_rows()>0){
			$result=array( 'sec_info' => $query1->result(),
				'signal' => 1,
			);
			return $result;
		}
		elseif ($query2->num_rows()>0){
			$result=array( 'sec_info' => $query2->result(),
				'signal' => 2,
			);
			return $result;
		}
		else{
			return FALSE;
		}
	}

	public function capital_info($data){
		$query=$this->db->select('*')->from('capital_acc')
			->where('sec_acc',$data['sec_acc'])
			->get();
		if($query->num_rows()>0){
			$result=$query->result();
			return $result;
		}else{
			return FALSE;
		}
	}


	public function create_new($data){
		$query=$this->db->select('*')
						->from('capital_acc')
						->where('sec_acc',$data['sec_acc'])
						->get();
		if($query->num_rows()!=0){
			$query = $query->row();
			$info=array(
				'cap_pwd'=>$query->cap_pwd,
				'sec_acc'=>$query->sec_acc,
				'active_cap'=>$query->active_cap,
				'frozen_cap'=>$query->frozen_cap,
			);
			$this->db->delete('capital_acc',$info);
			$op1=$this->db->affected_rows();
			$this->db->insert('capital_acc',$info);
			$op2=$this->db->affected_rows();
			if($op1&&$op2) return TRUE;
			else return FALSE;
		}else
			return FALSE;
	}



}
