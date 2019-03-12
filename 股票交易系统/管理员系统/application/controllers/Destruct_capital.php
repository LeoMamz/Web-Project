<?php
class Destruct_capital extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Destruct_capital_model');
		$this->load->library('session');
		$this->load->helper(array('form', 'url'));
	}

	public function index()
	{
		$this->load->view('login/index.php');
	}

	public function destruct_capital()
	{
		$user=$this->session->userdata('user');
		$data['user']=$user;
		$data['cap_acc']=$this->input->post('cap_acc');
		$data['ifcheck'] = FALSE;
		//$data['ifshow']=FALSE;

		//$data['ifreport'] =FALSE;

		if ($this->Destruct_capital_model->_check($data) === TRUE)
		{
			$data['ifcheck'] = TRUE;
			$func1=$this->Destruct_capital_model->security_info($data);
			$func2=$this->Destruct_capital_model->capital_info($data);
			if($func1!=FALSE&&$func2!=FALSE){
				//$data['ifshow']=TRUE;
				$data['sec_info']=$func1;
				$data['cap_info']=$func2;
			}
			//$this->session->set_userdata('user',array('id' => 1, 'name' => $data['user']) );
		}
		$result = json_encode($data);
		echo $result;
	}

	public function confirm_destruct(){
		$user=$this->session->userdata('user');
		$data['user']=$user;
		$data['cap_acc']=$this->input->post('cap_acc');
		//$data['ifsuccess'] = FALSE;
		$data['ifdestruct'] = FALSE;
		if($this->Destruct_capital_model->destruct_capital($data) === TRUE){
			$data['ifdestruct']=TRUE;
		}
		$result= json_encode($data);
		echo $result;
	}

}
