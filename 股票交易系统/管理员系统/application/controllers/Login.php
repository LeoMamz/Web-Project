<?php
class Login extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
		$this->load->library('session');
        $this->load->helper(array('form', 'url'));
    }

	public function index()
	{
		$this->load->view('login/index.php');
	}

	public function log_in()
	{
        $data['username'] = $this->input->post('form-username');
        $data['password'] = $this->input->post('form-password');
        $data['ifsuccess'] = FALSE;

        if ($this->login_model->_check($data) === TRUE)
        {
            $data['ifsuccess'] = TRUE;
            $this->session->set_userdata('user',array('id' => 1, 'name' => $data['username']) );
        }
        $result = json_encode($data);
        echo $result;
	}
	
}