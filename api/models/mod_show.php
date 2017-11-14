<?php
class Mod_show extends Shuyin_Model {

    public function __construct()
    {
        parent::__construct();
        $this->init();
    }

    //获取秀列表
    public function get_show_list($where, $page_size, $offset){
        if(!is_array($where)){
            log_error_message("wrong params : ".json_encode($where));
            return false;
        }
        $this->db->select("*")->from('sy_show');
        // if(isset($where['type'])){
        //     $this->db->where('type',$where['type']);
        // }
        $this->db->order_by('s_id','desc')->limit($page_size, $offset);

        $query = $this->db->get();
        $rows = $query->result_array();
        $query->free_result();

        return $rows;
    }
    
    //获取秀列表总数
    public function get_show_count(){
        $count = $this->db->count_all('sy_show');
        return $count;
    }

    //获取用户信息
    public function get_user_by_uid($uid){
        if(empty($uid)){
            return false;
        }
        $this->db->select('*')->from('sy_user');
        $this->db->where('u_id', $uid);
        $query = $this->db->get();
        $row = $query->row_array();
        $query->free_result();
        return $row;
    }

    //获取用户来源信息
    public function get_fromuser_by_uid($uid){
        if(empty($uid)){
            return false;
        }
        $this->db->select('*')->from('sy_fromuser');
        $this->db->where('u_id', $uid);
        $query = $this->db->get();
        $row = $query->row_array();
        $query->free_result();
        return $row;
    }
}
