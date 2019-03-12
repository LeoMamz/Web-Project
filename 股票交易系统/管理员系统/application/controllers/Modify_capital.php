<?php
class Modify_capital extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Modify_capital_model');
		$this->load->library('session');
		$this->load->helper(array('form', 'url'));
	}

	public function index()
	{
		$this->load->view('login/index.php');
	}

	public function modify_capital()
	{
		$user=$this->session->userdata('user');
		$data['user']=$user;
		$data['cap_acc']=$this->input->post('cap_acc');
		$data['cap_pwd_old']=$this->input->post('cap_pwd_old');
		$data['cap_pwd_new']=$this->input->post('cap_pwd_new');
		$data['ifsuccess'] = FALSE;

		//$data['ifreport'] =FALSE;

		if ($this->Modify_capital_model->modify_password($data) === TRUE)
		{
			$data['ifsuccess'] = TRUE;
		}
		$result = json_encode($data);
		echo $result;
	}
}
