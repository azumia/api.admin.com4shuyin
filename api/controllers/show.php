<?php
class Show extends Shuyin_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('mod_show');
        // $this->load->helper('url_helper');
    }

    public function get_show_list(){
        $type = intval($this->parse_get('type'));
        $where = array(
            'type' => $type
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
                $user_info = $this->mod_show->get_user_by_uid($row['u_id']);
                $rows[$key]['nickname'] = $user_info['nickname'];
                $rows[$key]['oldname'] = $user_info['oldname'];
                $rows[$key]['content'] = $row['s_content'];
                $rows[$key]['sku'] = $row['s_bracode'];
                $rows[$key]['addtime'] = $row['s_addtime'];
                $rows[$key]['state'] = $row['s_state'];
                $rows[$key]['settled'] = $row['s_settled'];
                $fromuser_info = $this->mod_show->get_fromuser_by_uid($row['u_id']);
                $rows[$key]['sourceno'] = $fromuser_info['f_source'];
            }
            $result ['total'] = $this->mod_show->get_show_count();
            $result ['rows'] = $rows;
        }

        $this->response_result(0, '', $result);
    }
}