<?php
class Destruct extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Destruct_model');
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
				$this->load->view('manage/destructSec.php', $data);
			else if ($type == 'legal')
				$this->load->view('manage/destructSec2.php', $data);
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
			$this->load->view('manage/destructCap.php', $data);
		// }
	}



// *****************************************
	// 判断输入的自然人证券账号是否有效
	public function natrural_if_valid()
	{

		$user=$this->session->userdata('user');
		$data['user'] = $user;

		$data['sec_acc'] = $this->input->post('sec_acc');
		$data['indentity_num'] = $this->input->post('form-identity_num');
		$data['if_exist'] = FALSE;

		if ($this->Reapply_model->natrual_if_exist($data) === TRUE)
		{
			$data['if_exist'] = TRUE;

			// 获取证券账户信息用来回显
			$info = array(
				'table_name' => 'natrual_security_acc',
				'attr_name' => 'sec_acc',
				'attr_val' => $data['sec_acc']
			);
			$data['natrual_security_acc_info'] = get_info($info);
		}

		$result = json_encode($data);
    	echo $result;
	}

	// 判断法人证券账户是否有效
	public function corp_if_valid()
	{
		
		$user=$this->session->userdata('user');
		$data['user'] = $user;

		$data['reg_id'] = $this->input->post('form-reg_id');
		$data['sec_acc'] = $this->input->post('form-sec_acc');
		$data['if_exist'] = FALSE;

		if ($this->Reapply_model->corp_if_exist($data) === TRUE)
		{
			$data['if_exist'] = TRUE;

			// 获取证券账户信息用来回显
			$info = array(
				'table_name' => 'corp_security_acc',
				'attr_name' => 'sec_acc',
				'attr_val' => $data['sec_acc']
			);
			$data['corp_security_acc_info'] = get_info($info);
		}

		$result = json_encode($data);
    	echo $result;		
	}

	// 注销证券账户,$info包含证券帐号类型还有证券帐号
	public function destruct($info)
	{
		$user=$this->session->userdata('user');
		$data['user'] = $user;

		$data['if_sold_out'] = FALSE;
		$data['if_success'] = FALSE;


		// 判断该证券账户名下的股票是否已经全部卖出
		if ($this->Reapply_model->if_sold_out($sec_acc) == TRUE)
		{
			$data['if_sold_out'] = TRUE;
			if ($this->Reapply_model->exec_destruct($info) == TRUE)
        		$data['if_success'] = TRUE;
		}
        	
		$result = json_encode($data);
    	echo $result;
	}
}