<?php
class Show extends Shuyin_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('mod_show');
        // $this->load->helper('url_helper');
    }

    //获取我秀列表
    public function get_show_list(){
        $this->load->model('mod_user');
        $nickname = trim($this->parse_get('nickname'));
        $type = intval($this->parse_get('type'));

        $arr_uid = array ();
        if(!empty($nickname)){
            $user_list = $this->mod_user->get_user_by_name($nickname);
            if(count($user_list)){
                foreach ($user_list as $key => $row) {
                    array_push($arr_uid, $row['u_id']);
                }
            }
        }
        $where = array(
            'type' => $type,
            'arr_uid' => $arr_uid
        );

        // 分页获取秀列表
        $show_list = $this->mod_show->get_show_list($where, $this->page_size, $this->offset);
        $rows = array();
        if(empty($show_list)){
            $result ['total'] = 0;
            $result ['rows'] = array ();
        } else {
            foreach ($show_list as $key=>$row){
                $rows[$key]['id'] = $row['s_id'];
                $rows[$key]['uid'] = $row['u_id'];
                $user_info = $this->mod_user->get_user_by_uid($row['u_id']);
                $rows[$key]['nickname'] = $user_info['nickname'];
                $rows[$key]['oldname'] = $user_info['oldname'];
                $rows[$key]['content'] = $row['s_content'];
                $rows[$key]['sku'] = $row['s_bracode'];
                $rows[$key]['addtime'] = $row['s_addtime'];
                $rows[$key]['state'] = $row['s_state'];
                $rows[$key]['settled'] = $row['s_settled'];
                $fromuser_info = $this->mod_user->get_fromuser_by_uid($row['u_id']);
                $rows[$key]['sourceno'] = $fromuser_info['f_source'];
                $rows[$key]['signs'] = $this->mod_user->get_signs_by_uid($row['u_id']);
                $user_lables = $this->mod_show->get_use_lable_by_sid($row['s_id']);
                $rows[$key]['lables'] = $user_lables;
            }
            $result ['total'] = $this->mod_show->get_show_count($where);
            $result ['rows'] = $rows;
        }

        $this->response_result(0, '', $result);
    }

    //获取我秀图片列表
    public function get_show_img_list(){
        $sid = trim($this->parse_get('sid'));
        $show_img_list = $this->mod_show->get_show_img_list($sid);
        $result = array();
        foreach ($show_img_list as $key=>$row){
            array_push($result, $row['p_qnsrc']);
        }
        $this->response_result(0, '', $result);
    }
}