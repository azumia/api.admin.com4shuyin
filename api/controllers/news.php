<?php
class News extends Shuyin_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('mod_news');
        // $this->load->helper('url_helper');
    }

    public function index()
    {
        $total = $this->mod_news->get_news();
        $this->result['data'] = $total[0];
        $this->response_result(0, '', $total);
    }


    public function getInfo(){
        $result = $this->mod_news->get_info();
        $this->response_result(0, '', $result);
    }
}
