<?php
class User extends Shuyin_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mod_user');
        // $this->load->helper('url_helper');
    }

    public function login()
    {
        $username = trim($this->parse_post ( 'username' ));
        $password = trim($this->parse_post ( 'password' ));
        // var_dump($username);
        $result = array('token' => 'admin');
        $this->response_result(0, '', $result);
    }

    public function info()
    {
        $token = trim($this->parse_get ( 'token' ));
        $result = array('avatar' => 'https://wpimg.wallstcn.com/f778738c-e4f8-4870-b634-56703b4acafe.gif', 'name' => 'admin', 'role' => array('admin'));
        $this->response_result(0, '', $result);
    }

    public function logout()
    {
        $token = trim($this->parse_post ( 'token' ));
        $result = array('success');
        $this->response_result(0, '', $result);
    }
}