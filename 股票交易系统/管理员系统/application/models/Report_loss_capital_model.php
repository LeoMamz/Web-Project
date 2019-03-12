<?php
class Report_loss_capital_model extends CI_Model {

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
//
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



	public function change_state($data){
		$op1 = $op2 = 0;
		$info=array(
			'if_frozen'=>1,
		);
		$query1=$this->db->select('*')->from('capital_acc')
						->where('sec_acc',$data['sec_acc'])
						->get();
		$query2=$this->db->select('*')->from('stock_info')
			->where('sec_acc',$data['sec_acc'])
			->get();
		if($query1->num_rows()!=0){
			$this->db->update('capital_acc',$info,array('sec_acc'=>$data['sec_acc']));
			$op1=$this->db->affected_rows();
		}
		if($query2->num_rows()!=0){
			$this->db->update('stock_info',$info,array('sec_acc'=>$data['sec_acc']));
			$op2=$this->db->affected_rows();
		}
		if($op1||$op2) return TRUE;
		else return FALSE;
	}

}
