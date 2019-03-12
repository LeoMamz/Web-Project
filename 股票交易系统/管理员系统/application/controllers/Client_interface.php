<?php
    /**
     * Created by PhpStorm.
     * User: Lucifer
     * Date: 2018/6/23
     * Time: 22:53
     */
class Client_interface extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->load->model('client_model');
    }

    public function account()
    {
        $postData = file_get_contents('php://input');
        $re = json_decode($postData);
//        if($re->userID == '123') {//这里是我自己测试的，可以删掉
//            $a = json_encode(array('type'=>true));
//            echo $a;
//        }
//         echo json_encode($re);
        if ($re->type == 1)//登陆
        {
            $data['id'] = $re->userID;
            $data['pwd'] = $re->userPWD;
            $Data['type'] = false;
//            echo json_encode($Data);
            $Data['type'] = $this->client_model->check_account($data);
            if ($Data['type'])
                $Data['re'] = $this->client_model->output_reminding($data);
            // $Data['rem'] = array('0' => array('1' => '1', '2' => '2'), array('1' => '1', '2' => '2'));
            echo json_encode($Data);
        }elseif($re->type == 2)//修改密码
        {
            $data['type'] = $re->type;
            $data['id'] = $re->user;
            $data['pwd'] = $re->oldPWD;
            $data['newPWD'] = $re->newPWD;
            // echo json_encode($data);
            $re = 0;
            if ($this->client_model->check_account($data))
                if ($this->client_model->modify_password($data))
                    $re = 1;
            echo json_encode($re);
        }
    }

    public function update_reminding()
    {
        $postData = file_get_contents('php://input');
        $re = json_decode($postData);
        $data['userID'] = $re->userID;
        $Data['re'] = $re->re;
        $this->client_model->input_reminding($re);
    }

    public function cap()
    {
        $postData = file_get_contents('php://input');
        $result = json_decode($postData);
        $data['userID'] = $result->user_id;
        $result = $this->client_model->get_cap($data);
        // $data['active_cap'] = $result['active_cap'];
        // $data['frozen_cap'] = $result['frozen_cap'];

        echo json_encode($result);
    }

    public function sec()
    {
        $postData = file_get_contents('php://input');
        $result = json_decode($postData);
        // echo json_encode($result);
        $data['userID'] = $result->user_id;
        $data['stockID'] = $result->stock_id;

        $result = $this->client_model->get_stock($data);

        echo json_encode($result);
    }

    public function cap_all()
    { 
        $data['userID'] = $this->input->post('name');
        $result = $this->client_model->get_cap($data);
        echo json_encode($result);
    }

    public function sec_all()
    {
        $data['userID'] = $this->input->post('name');
        $result = $this->client_model->get_stock_all($data);
        echo json_encode($result);

    }
}