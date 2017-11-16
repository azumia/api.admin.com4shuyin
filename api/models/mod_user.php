<?php
class Mod_user extends Shuyin_Model {

    public function __construct()
    {
        parent::__construct();
        $this->init();
    }

    public function get_news($slug = FALSE)
    {
        if ($slug === FALSE)
        {
            $query = $this->db->get('sy_news');
            return $query->result_array();
        }
    
        $query = $this->db->get_where('sy_news', array('slug' => $slug));
        return $query->row_array();
    }

    public function get_info(){
        $query = $this->db->get('sy_store');
        return $query->result_array();
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

    //根据名称获取用户信息
    public function get_user_by_name($name){
        if(empty($name)){
            return false;
        }
        $this->db->select('*')->from('sy_user');
        $this->db->distinct();
        $this->db->like('nickname', $name, 'both');
        $this->db->or_like('oldname', $name, 'both');
        $query = $this->db->get();
        $rows = $query->result_array();
        $query->free_result();
        return $rows;
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

    //获取用户体征信息
    public function get_signs_by_uid($uid){
        if(empty($uid)){
            return false;
        }
        $this->db->select('*')->from('sy_signs');
        $this->db->where('u_id', $uid);
        $query = $this->db->get();
        $row = $query->row_array();
        $query->free_result();
        return $row;
    }

}