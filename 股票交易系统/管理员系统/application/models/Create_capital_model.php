<?php
class Create_capital_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
		$this->load->helper('url_helper');
	}

	public function _check($data)
	{
		//$sql = "SELECT * FROM admin WHERE ID = '" . $data['username'] . "' AND password = '" . $data['password'] . "'";
		//$query = $this->db->query($sql);
		$query1 = $this->db->select('*')->from('natural_security_acc')
							->where('sec_acc', $data['sec_acc'])//security_id
							->where('identity_num',$data['identity_num'])
							->get();
		$query2 = $this->db->select('*')->from('legal_security_acc')
							->where('sec_acc', $data['sec_acc'])//security_id
							->where('corp_rep_id',$data['identity_num'])
							->get();
		if ($query1->num_rows() != 0||$query2->num_rows()!=0) return TRUE;
		else return FALSE;
	}

	public function security_info($data){
		$query1=$this->db->select('*')->from('natural_security_acc')
			->where('sec_acc',$data['sec_acc'])
			->get();
		$query2=$this->db->select('*')->from('legal_security_acc')
			->where('sec_acc',$data['sec_acc'])
			->get();
		if($query1->num_rows()>0){
			$result=array( 'sec_info' => $query1->result(),
				'signal' => 1 //自然人证券账户
			);
			return $result;
		}
		elseif ($query2->num_rows()>0){
			$result=array( 'sec_info' => $query2->result(),
				'signal' => 2 //法人证券账号
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

	public function create_capital($data){
		$pwd=$data['identity_num'];
		$pwd=substr($pwd,strlen($pwd)-6);
		$info=array(
			'cap_pwd'=>$pwd,
			'sec_acc'=>$data['sec_acc'],
			'active_cap'=> 0,
			'frozen_cap'=> 0
		);
		$query=$this->db->select('*')->from('capital_acc')
			->where('sec_acc',$data['sec_acc'])
			->get();
		if($query->num_rows()!=0){
			return FALSE;
		}else{
			$this->db->insert('capital_acc',$info);
			$op=$this->db->affected_rows();
			if($op) return TRUE;
			else return FALSE;
		}
	}
}





