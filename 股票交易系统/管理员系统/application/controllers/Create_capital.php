<?php
class Create_capital extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Create_capital_model');
		$this->load->library('session');
		$this->load->helper(array('form', 'url'));//?
	}

	public function index()
	{
		$this->load->view('login/index.php');//?
	}

	public function create_capital()
	{
		$user=$this->session->userdata('user');
		$data['user']=$user;
		$data['sec_acc'] = $this->input->post('sec_id');
		$data['identity_num'] = $this->input->post('identity_id');
		$data['ifsuccess'] = FALSE;
		$data['ifinsert']=FALSE;


		if ($this->Create_capital_model->_check($data) === TRUE)
		{
			$data['ifsuccess'] = TRUE;
			if($this->Create_capital_model->create_capital($data) === TRUE)
			{
				$data['ifinsert']=TRUE;
				$func1=$this->Create_capital_model->security_info($data);
				$func2=$this->Create_capital_model->capital_info($data);
				if($func1!=FALSE&&$func2!=FALSE){

					$data['sec_info']=$func1;
					$data['cap_info']=$func2;
				}
			}
			//$this->session->set_userdata('user',array('id' => 1, 'name' => $data['user']) );//?
		}

		$result = json_encode($data);
		echo $result;
	}

}
