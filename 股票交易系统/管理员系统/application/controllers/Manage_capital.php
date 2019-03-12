<?php
class Manage_capital extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Manage_capital_model');
		$this->load->library('session');
		$this->load->helper(array('form', 'url'));
	}

	public function index()
	{
		$this->load->view('login/index.php');
	}

	public function manage_capital()
	{
		$user=$this->session->userdata('user');
		$data['user']=$user;
		$data['op_type']=$this->input->post('op_type');
		$data['cap_acc']=$this->input->post('cap_acc');
		$data['amount']=$this->input->post('amount');
		$data['ifsuccess'] = FALSE;

		//$data['ifreport'] =FALSE;

		if ($this->Manage_capital_model->manage_capital($data) === TRUE)
		{
			$data['ifsuccess'] = TRUE;
			$func1=$this->Manage_capital_model->security_info($data);
			$func2=$this->Manage_capital_model->capital_info($data);
			if($func1!=FALSE&&$func2!=FALSE){
				$data['sec_info']=$func1;
				$data['cap_info']=$func2;
			}
			//$this->session->set_userdata('user',array('id' => 1, 'name' => $data['user']) );
		}
		$result = json_encode($data);
		echo $result;
	}
}
