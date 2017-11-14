<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *@file DDBOptLogger.php
 *@brief 运营日志类
 *@author james@dadabus.com
 *@version 1.0
 *@date 2015-05-14
 *@note 
 */

class DDBOptLogger {
	public function __construct() {
		
	}
	
	public function __destruct() {
		if (!$this->output_finish) {
			$this->output_log();
		}
	}
	
	public function set_protocol($protocol_id, $protocol_desc) {
		$this->protocol_id = $protocol_id;
		$this->protocol_desc = $protocol_desc;
	}
	
	public function set_field($field_name, $field_value, $replace = FALSE) {
		if ($replace) {
			$this->opt_log_data[$field_name] = $field_value;
		}
		else if (!isset($this->opt_log_data[$field_name])) {
			$this->opt_log_data[$field_name] = $field_value;
		}
	}
	
	public function set_file($file) {
		$this->file = $file;
	}
	
	public function output_log() {
		if (null === $this->file) {
			return ;
		}
		$this->output_finish = true;
		if (!is_integer($this->protocol_id) && !is_string($this->protocol_id)) {
			log_error_message('protocol_id type error. protocol type is: ' . gettype($this->protocol_id));
			return ;
		}
		if (!is_array($this->protocol_desc)) {
			log_error_message('protocol_desc type error. protocol type is: ' . gettype($this->protocol_desc));
			return ;
		}
		if (!is_array($this->opt_log_data)) {
			log_error_message('opt_log_data type error. protocol type is: ' . gettype($this->opt_log_data));
			return ;
		}
	
		$opt_log = '';
		// 填充公共信息
		$running_info = get_running_info();
		$msg_no = isset($running_info['msg_no']) ? $running_info['msg_no'] : '';
		$client_ip = isset($running_info['client_ip']) ? $running_info['client_ip'] : '';
		$class = isset($running_info['class']) ? $running_info['class'] : '';
		$method = isset($running_info['method']) ? $running_info['method'] : '';
		$start_time = isset($running_info['start_time']) ? $running_info['start_time'] : '';
		$end_time = microtime(true);
		$elapse_time = $end_time - $start_time;
		$local_ip = isset($running_info['local_ip']) ? $running_info['local_ip'] : '';
		$opt_log = $this->protocol_id . '|' . $start_time . '|' . $elapse_time . '|' . $local_ip;
		$opt_log = $opt_log . '|' . $msg_no . '|' . $client_ip . '|' . $class . '|' . $method;
		foreach ($this->protocol_desc as $key) {
			$item = isset($this->opt_log_data[$key]) ? $this->opt_log_data[$key] : '';
			$item = $this->escape_opt_log($item);
			$opt_log = $opt_log . '|' . $item;
		}
		$opt_log .= "\n";
		$this->real_output_log($opt_log);
	}
	
	static public function escape_opt_log($data) {
		return $data;
	}
	
	static public function unescape_opt_og($data) {
		return $data;
	}
	
	private function real_output_log($log) {
		if (null === $this->file) {
			log_error_message('load config failed. protocol_id=' . $this->protocol_id);
			return ;
		}
		$fd = @fopen($this->file, 'a');
		if (FALSE === $fd) {
			log_error_message('open opt log file(' . $this->file . ') failed. protocol_id=' . $this->protocol_id);
			return ;
		}
		$ret = fwrite($fd, $log, strlen($log));
		if (!$ret) {
			log_error_message('write log failed: protocol_id=' . $this->protocol_id);
		}
		fclose($fd);
	}
	
	private $protocol_id = null;				//$protocol_id 协议ID，事先分配好
	private $protocol_desc = null;				//$protocol = array('field_name1', 'field_name2')
	private $opt_log_data = array();			//实际数据，关联数组: $opt_log_data = array('field_name1' => data1, 'field_name2' => data2);
	private $output_finish = false;
	private $file = null;
}

?>
