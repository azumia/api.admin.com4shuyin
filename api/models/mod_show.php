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

    // 获取我秀图片
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

    // 更新我秀状态
    public function update_show_state($where) {
        if(empty($where['arr_sid'])){
            return false;
        }

        // 事务处理
        try {
            $this->db->trans_begin ();

            //审核通过以后增加积分
            if($where['state'] == '1') {
                //查询秀id对应的uid
                $this->db->select('u_id')->distinct()->from('sy_show');
                $this->db->where_in('s_id', $where['arr_sid']);
                $this->db->where('s_state', 0);
                $query = $this->db->get();
                $uid_rows = $query->result_array();
                if(empty($uid_rows)) {
                    throw new Exception ( 'select u_id info failed' );
                }
                $arr_uid = array();
                foreach ($uid_rows as $key => $value) {
                    array_push($arr_uid, $value['u_id']);
                }
                var_dump($arr_uid);
                $this->db->set('integral', 'integral+30', FALSE);
                $this->db->where_in('u_id', $arr_uid);
                $this->db->update('sy_integral'); 
                $integral_affected_show = $this->db->affected_rows();
                var_dump($this->db->last_query());
                if(empty($integral_affected_show)) {
                    throw new Exception ( 'update sy_integral info failed' );
                }

                //添加积分日志
                foreach ($arr_uid as $key => $value) {
                    $integral_log = array(
                        'u_id' => $value,
                        'integral' => '30',
                        'descript' => '一条我秀ID为：'.$value.' 通过审核积分+30',
                        'addtime' => date("Y-m-d H:i:s")
                    );
                    $this->db->insert('sy_integraldetail', $integral_log);
                }
            }
            
            //修改审核状态
            $this->db->set('s_state', $where['state']);
            $this->db->where_in('s_id', $where['arr_sid']);
            if($where['state'] == '1') {
                $this->db->where('s_state', 0);
            }else{
                $this->db->where('s_state', 1);
            }
            $this->db->update('sy_show');
            $affected_show = $this->db->affected_rows();
            if(empty($affected_show)) {
                throw new Exception ( 'update sy_show info failed' );
            }
        } catch ( Exception $e ) {
            $this->db->trans_rollback ();
            return FALSE;
        }
        
        if ($this->db->trans_status () === FALSE) {
            $this->db->trans_rollback ();
            return FALSE;
        } else {
            $this->db->trans_commit ();
            return TRUE;
        }
      
    }
}
