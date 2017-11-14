<?php
/**
 * 数据模型基类
 * @author Administrator
 *
 */
class Shuyin_Model extends CI_Model {
	
	// 默认数据库
	protected $_database = 'default';
	/**
	 * 构造函数
	 */
	public function __construct() {
		parent::__construct ();
	}
	
	/**
	 * 由于ci在load->model的时候 会实例化MTA_MODEL一次
	 * 将连接数据库的操作放在构造器会增加数据库连接的开销
	 * 故单独提取方法做数据库的连接操作 可在子类调用此init的方法
	 * $this->load->database第二个参数设置为TRUE 便于多库的切换
	 */
	public function init() {
		// 原来的方式， 名称 init 会建立一次连接， 那每一次 ci 都会生成多个连接， 会造成 mysql 连接过多
// 		if ($this->_database == '') {
// 			$this->db = $this->load->database ( 'default', TRUE );
// 		} else {
// 			$this->db = $this->load->database ( $this->_database, TRUE );
// 		}

		$name = 'default';
		if(!empty($this->_database)){
			$name = $this->_database;
		}

		$CI = &get_instance();

		if(empty($CI->mydb)){
			$CI->mydb = array();
		}

		if(empty($CI->mydb[$name])){
			$CI->mydb[$name] = $this->load->database ( $name, TRUE );
		}
		$this->db = $CI->mydb[$name];
	}
	
	/**
	 * 设置链接的数据库
	 * 
	 * @param unknown $database        	
	 */
	public function set_database($database) {
		if (isset ( $database )) {
			$this->_database = $database;
		}
	}

    /**
     * 载入一个 db
     *
     * @param string $name
     *        	db配置名称
     */
    public function load_database($name = 'default') {
        $CI = &get_instance ();

        if (empty ( $CI->mydb )) {
            $CI->mydb = array ();
        }

        if (empty ( $CI->mydb [$name] )) {
            $CI->mydb [$name] = $this->load->database ( $name, TRUE );
        }
        return $CI->mydb [$name];
    }
	
	/**
	 * 获取单行数据
	 * 
	 * @param unknown $sql        	
	 * @return unknown|boolean
	 */
	public function get_row($sql) {
		$query = $this->db->query ( $sql );
		$row = $query->row_array ();
		
		return $row;
	}
	
	/**
	 * 获取完整的数据集
	 * 
	 * @param unknown $sql        	
	 * @return unknown|boolean
	 */
	public function get_all($sql) {
		$query = $this->db->query ( $sql );
		$rows = $query->result_array ();
		
		return $rows;
	}
	
	/**
	 * 获取行数
	 * @param unknown $sql
	 * @return number
	 */
	public function get_count($sql){
		$query = $this->db->query ( $sql );
		$count = $query->num_rows () > 0 ? $query->row ()->count : 0;
		return $count;
	}
	
	
	
	/**
	 * 转义 in 查询
	 * @param unknown $list
	 * @return boolean
	 */
	public function escape_in($list){
		if(!is_array($list) || count($list) == 0){
			return FALSE;
		}
		
		$str = '';
		foreach ($list as $unit){
			$str.= $this->db->escape($unit) . ',';
		}
		return substr($str, 0, strlen($str) - 1);
	}
}