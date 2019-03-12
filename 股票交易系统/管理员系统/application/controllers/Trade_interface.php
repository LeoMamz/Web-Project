<?php
class Client_interface extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->load->model('client_model');
        $this->load->model('trade_model_model');
    }

	public function record()
    {
        $postData = file_get_contents('php://input');
        $result = json_decode($postData);

        $data['sell_id'] = $result->sell_id;
        $data['buy_id'] = $result->buy_id;
        $data['stock_name'] = $result->stock_name;
        $data['stock_code'] = $result->stock_code;
        $data['now_num'] = $result->stock_num;
        $data['price'] = $result->price;

        $result_buy = $this->client_model->get_stock_buy($data);
        $result_sell = $this->client_model->get_stock_sell($data);

        $data['total_cost'] = $result_buy['total_cost'];
        $data['stock_num'] = $result_buy['stock_num'];

        $data['buy_total_cost'] = $data['total_cost'] + $data['now_num'] * $data['pricr'];
        $data['buy_stock_num'] = $data['stock_num'] + $data['now_num'];
        $this->trade_model->update_stock_buy($data);

        $data['total_cost'] = $result_sell['total_cost'];
        $data['stock_num'] = $result_sell['stock_num'];

        $data['sell_total_cost'] = $data['total_cost'] - $data['now_num'] * $data['price'];
        $data['sell_stock_num'] = $data['stock_num'] - $data['now_num'];
        $this->trade_model->update_stock_sell($data);

    }

}