<?php
class Report_loss_capital extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Report_loss_capital_model');
		$this->load->library('session');
		$this->load->helper(array('form', 'url'));
	}

	public function index()
	{
		$this->load->view('login/index.php');
	}

	public function report_loss_capital()
	{
		$user=$this->session->userdata('user');
		$data['user']=$user;
		$data['sec_acc']=$this->input->post('sec_acc');
		$data['ifsuccess'] = FALSE;
		//$data['ifshow']=FALSE;

		//$data['ifreport'] =FALSE;

		if ($this->Report_loss_capital_model->_check($data) === TRUE)
		{
			$data['ifsuccess'] = TRUE;
			$func1=$this->Report_loss_capital_model->security_info($data);
			$func2=$this->Report_loss_capital_model->capital_info($data);
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

	public function confirm_report(){
		$user=$this->session->userdata('user');
		$data['user']=$user;
		$data['sec_acc']=$this->input->post('sec_acc');
		//$data['ifsuccess'] = FALSE;
		$data['ifreport'] =FALSE;
		if($this->Report_loss_capital_model->change_state($data)===TRUE){
			$data['ifreport']=TRUE;
		}
		$result= json_encode($data);
		echo $result;
	}

}
