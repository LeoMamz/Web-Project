<?php
class Destruct_capital_model extends CI_Model {

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


//	public function security_info($data){
//		$query=$this->db->select('*')->from('natrual_security_acc')
//			->where('cap_acc',$data['cap_acc'])
//			->get();
//		if($query->num_rows()>0){
//			$result=$query->result();
//			return $result;
//		}else{
//			return FALSE;
//		}
//	}

	public function security_info($data){
		$sec_id=$this->db->select('sec_acc')->from('capital_acc')
			->where('cap_acc',$data['cap_acc'])
			->get()->row()->sec_acc;
		$query1=$this->db->select('*')->from('natural_security_acc')
			->where('sec_acc',$sec_id)
			->get();
		$query2=$this->db->select('*')->from('legal_security_acc')
			->where('sec_acc',$sec_id)
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
			->where('cap_acc',$data['cap_acc'])
			->get();
		if($query->num_rows()>0){
			$result=$query->result();
			return $result;
		}else{
			return FALSE;
		}
	}

	public function destruct_capital($data){
		$query1=$this->db->select('*')->from('capital_acc')
						->where('cap_acc',$data['cap_acc'])
						->get();
		if($query1->num_rows()>0){
			$query1=$query1->row();
			$fund1=$query1->active_cap;
			$fund2=$query1->frozen_cap;
			if($fund1!=0||$fund2!=0){
				return FALSE;
			}else{
				$this->db->delete('capital_acc',array('cap_acc'=>$data['cap_acc']));
				$op1=$this->db->affected_rows();
				if($op1) return TRUE;
				else return FALSE;
			}
		}else{
			return FALSE;
		}


	}



}
