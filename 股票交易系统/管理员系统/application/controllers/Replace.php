<?php
class Replace extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
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
}