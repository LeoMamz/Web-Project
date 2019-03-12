<?php
class Reapply extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Reapply_model');
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
				$this->load->view('manage/replaceSec.php', $data);
			else if ($type == 'legal')
				$this->load->view('manage/replaceSec2.php', $data);
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
			$this->load->view('manage/replaceCap.php', $data);
		// }
	}


// ***********************
	// 判断自然人证券账户是否有效
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
				'table_name' => 'natrual_security_acc',
				'attr_name' => 'indentity_num',
				'attr_val' => $data['indentity_num']
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
		$data['corp_rep_id'] = $this->input->post('form-corp_rep_id');
		$data['if_exist'] = FALSE;

		if ($this->Reapply_model->corp_if_exist($data) === TRUE)
		{
			$data['if_exist'] = TRUE;
			$info = array(
				'table_name' => 'corp_security_acc',
				'attr_name' => 'reg_id',
				'attr_val' => $data['reg_id']
			);
			$data['corp_security_acc_info'] = get_info($info);
		}

		$result = json_encode($data);
    	echo $result;		
	}

	// 补办证券账户，info包含证券账户类型（natrual或者corp）以及证券帐号
	public function reapply($info)
	{
		$user=$this->session->userdata('user');
		$data['user'] = $user;

		$data['if_report'] = FALSE;
		$data['if_success'] = FALSE;


		// 判断该证券账户是否已经挂失，只有已经挂失的账户才能补办
		// 未挂失的话返回FALSE，已挂失的话返回该证券账户所有信息
		$re = $this->Reapply_model->if_report($info);		
		if ($re != FALSE)
		{
			$data['if_report'] = TRUE;

			if($info['type'] == 'natrual')
	            $re['table_name'] = 'natrual_security_acc';
	        else if ($info['type'] == 'corp') 
	        	$re['table_name'] = 'corp_security_acc';
	        // 执行重新开户操作，返回新账户的所有信息
			$re = $this->Reapply_model->exec_reapply($re);
			if ( $re != FALSE)
			{
        		$data['sec_acc_info'] = $re;
        	}
		}
        	
		$result = json_encode($data);
    	echo $result;
	}
}