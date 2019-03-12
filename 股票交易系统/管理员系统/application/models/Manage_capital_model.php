<?php
class Manage_capital_model extends CI_Model {

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
				'sigal' => 1,
			);
			return $result;
		}
		elseif ($query2->num_rows()>0){
			$result=array( 'sec_info' => $query2->result(),
				'sigal' => 2,
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


	public function manage_capital($data){
		$query=$this->db->select('*')->from('capital_acc')
						->where('cap_acc',$data['cap_acc'])
						->get();
		if($query->num_rows()>0){
			$query=$query->row();
			$state=$query->if_frozen;
			$amount=$query->active_cap;
			if($state!=0){
				return FALSE;
			}else{
				if($data['op_type']=='Deposit'){
					$amount=$amount+$data['amount'];
				}elseif ($data['op_type']=='Withdraw'){
					if($amount>=$data['amount']){
						$amount=$amount-$data['amount'];
					}else return FALSE;
				}
				$this->db->update('capital_acc',array('active_cap'=>$amount),array('cap_acc'=>$data['cap_acc']));
				$op1=$this->db->affected_rows();
				if($op1) return TRUE;
				else return FALSE;
			}
		}else{
			return FALSE;
		}
	}




}
