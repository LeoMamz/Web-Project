<?php
class Create extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Create_security_model');
		$this->load->library('session');
        $this->load->helper(array('form', 'url'));
    }

    public function index()
	{
		
	}

	public function security($type)
	{
		//$this->session->unset_userdata('user');
		$user=$this->session->userdata('user');
		//var_dump($user);
  //       if ($user == null)
  //       {
  //       	echo "<script>alert('Please login!');window.location.href='Login';</script>";
  //       }
		// elseif ($user != null) {
			$data['user'] = $user;
			if ($type == 'natual')
				$this->load->view('manage/createSec.php', $data);
			else if ($type == 'legal')
				$this->load->view('manage/createSec2.php', $data);
		// }
	}

	public function capital()
	{
		//$this->session->unset_userdata('user');
		$user=$this->session->userdata('user');
		//var_dump($user);
  //       if ($user == null)
  //       {
  //       	echo "<script>alert('Please login!');window.location.href='Login';</script>";
  //       }
		// elseif ($user != null) {
			$data['user'] = $user;
			$this->load->view('manage/createCap.php', $data);
		// }
	}


// *****************************************


	public function create_natural_sec()
	{
		//$this->session->unset_userdata('user');
		$user=$this->session->userdata('user');
		$data['user'] = $user;			

		$data['name'] = $this->input->post('form-name');
        $data['gender'] = $this->input->post('form-gender');
        $data['identity_num'] = $this->input->post('form-identity_num');
        $data['address'] = $this->input->post('form-address');
        $data['occupation'] = $this->input->post('form-occupation');
        $data['education'] = $this->input->post('form-education');
        $data['company'] = $this->input->post('form-company');
        $data['tel'] = $this->input->post('form-tel');
        $data['if_agency'] = $this->input->post('form-if_agency');
        if($data['if_agency'] == "1")
        	$data['agent_id'] = $this->input->post('form-agent_id');
        

        $data['if_exist'] = TRUE;
        $data['if_create'] = FALSE;

        if ($this->Create_security_model->natural_if_exist($data) === FALSE)
    	{
        	$data['if_exist'] = FALSE;
        	if($this->Create_security_model->create_natural_security_acc($data) === TRUE)
        	{
        		$data['if_create'] = TRUE;
        		$info = array(
					'table_name' => 'natural_security_acc',
					'attr_name' => 'identity_num',
					'attr_val' => $data['identity_num']
				);
				$data['natural_sec_acc_info'] = $this->Create_security_model->get_info($info);
        	}
    	}

		$result = json_encode($data);
    	echo $result;
	}

	public function create_corp_sec()
	{
		//$this->session->unset_userdata('user');
		$user=$this->session->userdata('user');

		$data['user'] = $user;			

		// 缺少一个法定代表人姓名，需要修改顺序
		$data['corp_name'] = $this->input->post('form-corpname');
		$data['reg_id'] = $this->input->post('form-reg_id');
		$data['license'] = $this->input->post('form-license');
		$data['corp_tel'] = $this->input->post('form-corp_tel');
		$data['corp_address'] = $this->input->post('form-corp_address');
		$data['corp_rep_name'] = $this->input->post('form-corp_rep_name');
		$data['corp_rep_id'] = $this->input->post('form-corp_rep_id');
		$data['auth_name'] = $this->input->post('form-auth_name');
		$data['auth_id'] = $this->input->post('form-auth_id');
		$data['auth_tel'] = $this->input->post('form-auth_tel');
		$data['auth_addr'] = $this->input->post('form-auth_addr');	

        $data['if_exist'] = TRUE;
        $data['if_create'] = FALSE;

        if ($this->Create_security_model->corp_if_exist($data) === FALSE)
    	{
        	$data['ifsuccess'] = FALSE;
        	if($this->Create_security_model->create_corp_security_acc($data) === TRUE)
        	{
        		$data['ifcreate'] = TRUE;
        		$info = array(
					'table_name' => 'legal_security_acc',
					'attr_name' => 'reg_id',
					'attr_val' => $data['reg_id']
				);
				$data['corp_sec_acc_info'] = $this->Create_security_model->get_info($info);
        	}

    	}

		$result = json_encode($data);
    	echo $result;
	}



}