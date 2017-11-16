<?php
class Mod_show extends Shuyin_Model {

    // protected $_database = 'localtest';
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
        if(!empty($where['type'])) {
            $this->db->where('s_state',$where['type']);
        }
        if(count($where['arr_uid'])) {
            $this->db->where_in('u_id', $where['arr_uid']);
        }
        $this->db->order_by('s_id','desc')->limit($page_size, $offset);

        $query = $this->db->get();
        $rows = $query->result_array();
        $query->free_result();

        return $rows;
    }
    
    //获取秀列表总数
    public function get_show_count($where){
        if(!is_array($where)){
            log_error_message("wrong params : ".json_encode($where));
            return false;
        }
        if(!empty($where['type'])) {
            $this->db->where('s_state',$where['type']);
        }
        if(count($where['arr_uid'])) {
            $this->db->where_in('u_id', $where['arr_uid']);
        }
        $this->db->from('sy_show');
        $count = $this->db->count_all_results();
        return $count;
    }
    
    // 获取我秀标签
    public function get_use_lable_by_sid($sid) {
        if(empty($sid)){
            return false;
        }
        $this->db->select('*')->from('sy_uselabel');
        $this->db->where('s_id', $sid);
        $query = $this->db->get();
        $rows = $query->result_array();
        $query->free_result();
        $use_lables = '';
        foreach ($rows as $key => $row) {
            $use_lables = $use_lables. ' '.$row['l_title'];
        }
        return $use_lables;
    }

    // 获取我秀标签
    public function get_show_img_list($sid) {
        if(empty($sid)){
            return false;
        }
        $this->db->select('*')->from('sy_photo');
        $this->db->where('s_id', $sid);
        $query = $this->db->get();
        $rows = $query->result_array();
        $query->free_result();
        return $rows;
    }
}
