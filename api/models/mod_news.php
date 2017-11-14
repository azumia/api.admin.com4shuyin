<?php
class Mod_news extends Shuyin_Model {

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
    
}
