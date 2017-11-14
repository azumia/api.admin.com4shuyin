<?php
/**
 * 应用程序类，包括通用处理函数与方法
 * @author Administrator
 *
 */
class application {
	
	/*
	 * 控制器数据输出方法，包括字符串与json两种数据格式
	 */
	public function gri_output($output, $type = 'json') {
		if ($type == 'debug' or (isset ( $_GET ['debug'] ) && intval ( $_GET ['debug'] ) == 1)) {
			header ( "Content-type: text/json; charset=utf-8" );
			echo '<pre style="background-color:#000000;color:#FFFFFF;">';
			print_r ( $output );
			echo '</pre>';
		} elseif ($type == 'json') {
			header ( "Content-type: text/json; charset=utf-8" );
			if (isset ( $_GET ['cb'] ) && trim ( $_GET ['cb'] ) != '') {
				echo trim ( $_GET ['cb'] ) . '(' . json_encode ( $output ) . ')';
			} else {
				echo json_encode ( $output );
			}
		} elseif ($type == 'str') {
			echo $output;
		}
		exit ( 0 );
	}
	
	/**
	 * 输出错误信息
	 * 
	 * @param unknown $msg        	
	 */
	public function output_error($msg) {
		$this->output_msg ( $msg, - 1 );
	}
	
	/**
	 * 输出成功
	 * 
	 * @param unknown $msg        	
	 */
	public function output_success($msg) {
		$this->output_msg ( $msg, 0 );
	}
	
	/**
	 * 输出信息
	 * 
	 * @param unknown $msg        	
	 * @param unknown $code        	
	 */
	private function output_msg($msg, $code) {
		$result ['code'] = $code;
		$result ['msg'] = $msg;
		$this->gri_output ( $result );
	}
}
