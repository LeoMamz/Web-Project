<?php
class Report extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Report_model');
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
				$this->load->view('manage/reportSec.php', $data);
			else if ($type == 'legal')
				$this->load->view('manage/reportSec2.php', $data);
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
			$this->load->view('manage/reportCap.php', $data);
		// }
	}


//***************************************

	// 判断输入的自然人证券账号是否有效
	public function natrural_if_valid()
	{

		$user=$this->session->userdata('user');
		$data['user'] = $user;

		$data['indentity_num'] = $this->input->post('form-identity_num');
		$data['if_exist'] = FALSE;

		if ($this->Reapply_model->natrual_if_exist($data) === TRUE)
		{
			$data['if_exist'] = TRUE;
			$info = array(
				'table_name' => 'natrucorp_security_acc',
				'attr_name' => 'indentity_num',
				'attr_val' => $data['indentity_num']
			);
			$data['natrual_sec_acc_info'] = get_info($info);
		}

		$result = json_encode($data);
    	echo $result;
	}

	// 判断输入的法人证券账号是否有效
	public function corp_if_valid()
	{
		
		$user=$this->session->userdata('user');
		$data['user'] = $user;

		$data['reg_id'] = $this->input->post('form-reg_id');
		$data['corp_rep_id'] = $this->input->post('form-corp_rep_id');
		$data['if_exist'] = FALSE;

		if ($this->Reapply_model->corp_if_exist($data) === TRUE)
		{
			$data['if_exist'] = TRUE;
			$info = array(
				'table_name' => 'corp_sec_acc',
				'attr_name' => 'reg_id',
				'attr_val' => $data['reg_id']
			);
			$data['corp_sec_acc_info'] = get_info($info);
		}

		$result = json_encode($data);
    	echo $result;		
	}

	// 冻结证券账户以及该证券账户下的所有的证券,info包含证券账户类型以及证券帐号
	public function Frozen($info)
	{
		
		$user=$this->session->userdata('user');
		$data['user'] = $user;

		$data['if_report'] = FALSE;
		$data['if_success'] = FALSE;

		// 挂失并冻结账户
		if($this->Report_model->exec_frozen($info) == 'xx')
			$data['if_report'] = TRUE;
		else if ($this->Report_model->exec_frozen($info) === TRUE)
		{
        	$data['if_success'] = TRUE;
		}

		$result = json_encode($data);
    	echo $result;

	}

}