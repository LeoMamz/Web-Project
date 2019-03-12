<?php
class Manage extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->library('session');
        $this->load->helper(array('form', 'url'));
    }

    public function index()
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
			$this->load->view('manage/index.php', $data);
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
			$this->load->view('manage/capitalManage.php', $data);
		// }
	}

	public function password()
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
			$this->load->view('manage/passwordManage.php', $data);
		// }
	}
}