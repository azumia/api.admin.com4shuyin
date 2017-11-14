<?php
/**
 * 控制器基类
 * @author Administrator
 *
 */
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Shuyin_Controller extends CI_Controller {
	// 城市编码， 使用高德编码
	public $city_code;
	
	// 分页大小，分页时使用，默认10
	public $page_size = 10;
	
	// 分页页码，分页时使用，默认1，从1开始
	public $page_index = 1;
	
	// 页偏移，分页时是使用，默认0
	public $offset = 0;
	
	public $mobile = null;

	public $token = null;
	public $nonce = null;
	
	public $user = null;
	public $uid = null;
	public $lat = null;
	public $lng = null;
	public $login_type_desc = null;
	
	// 设备ID
	public $device_id = '';
	
	// 客户端类型：1-安卓、2-IOS、3-web
	public $device_type = '1';

	//客户端版本号
	public $version = '';
	
	// 响应客户端的通用数据
	public $result = array (
			'ret' => 0,
			'msg' => '',
			'server_time' => '',
			'data' => array () 
	);
	
	public function init_input_params(){
		// 页大小
		$this->page_size = intval ( trim ( $this->parse_request ( 'page_size' ) ) ) ? intval ( trim ( $this->parse_request ( 'page_size' ) ) ) : intval ( trim ( $this->parse_request ( 'rows' ) ) );
		if(empty($this->page_size)){
			$this->page_size = 10;
		}
		// 每次拉取的数据总数为50
		if ($this->page_size > 200) {
			$this->page_size = 200;
		}
		// 页码
		$this->page_index = intval ( trim ( $this->parse_request ( 'page_index' ) ) ) ? intval ( trim ( $this->parse_request ( 'page_index' ) ) ) : intval ( trim ( $this->parse_request ( 'page' ) ) );
		if ($this->page_index < 1) {
			$this->page_index = 1;
		}
		// 计算分页偏移
		$this->offset = ($this->page_index - 1) * $this->page_size;
		
		$this->uid = $this->parse_request ( 'uid' );
		$this->token = $this->parse_request ( 'token' );
		$this->device_id = $this->parse_request ( 'device_id' );
		$this->device_type = $this->parse_request ( 'device_type' );
		$this->nonce = $this->parse_request ( 'nonce' );
		$this->version = $this->parse_request ( 'version' );
	}
	
	/**
	 * 控制器
	 */
	public function __construct() {
		parent::__construct ();
		
		header ( 'Content-type: application/json' );
		date_default_timezone_set ( 'PRC' ); // 设置中国时区

		// 解决跨域问题
		$this->_solve_cros_domain ();
		                                     
		// 导入通用的配置文件和相关类库
		$this->load->config ( 'setting' );
		$this->load->config ( 'result' );
		$this->load->library ( 'application' );
		$this->load->helper ( 'common' );
		
		$this->result_config = $this->config->item('result');
		// 导入运营日志类
		// $this->load->library ( 'DDBOptLogger' );
		// $opt_log_file = $this->config->item ( 'ddb_opt_log_file' );
		// if (! isset ( $opt_log_file ) || empty ( $opt_log_file )) {
		// 	log_error_message ( "ddb_opt_log_file not set" );
		// } else {
		// 	$real_opt_log_file = $opt_log_file . '.' . date ( 'Ymd' ) . '.log';
		// 	$this->ddboptlogger->set_file ( $real_opt_log_file );
			
		// 	// 使用默认的运营日志配置
		// 	// global $DDB_OPT_LOG_PROTOCOL_COMM;
		// 	// $protocol_id = DDB_OPT_LOG_ID_COMM;
		// 	// $protocol_desc = $DDB_OPT_LOG_PROTOCOL_COMM;
		// 	// $this->ddboptlogger->set_protocol ( $protocol_id, $protocol_desc );
		// }
		
		// 初始化请求的参数
		$this->init_input_params ();
		
		$this->result ['server_time'] = date ( 'Y-m-d H:i:s' );
	}
	public function __destruct() {
 		// if (null != $this->ddboptlogger) {
 		// 	// $this->ddboptlogger->set_field ( DDB_OPT_LOG_FD_VERSION, $this->version );
 		// 	// $this->ddboptlogger->set_field ( DDB_OPT_LOG_FD_MOBILE, $this->mobile );
 		// 	// $this->ddboptlogger->set_field ( DDB_OPT_LOG_FD_USER_ID, $this->uid );
 		// 	// $this->ddboptlogger->set_field ( DDB_OPT_LOG_FD_LOGIN_TYPE, $this->login_type_desc );
 		// 	// $this->ddboptlogger->set_field ( DDB_OPT_LOG_FD_DEVICE_ID, $this->device_id );
 		// 	// $this->ddboptlogger->set_field ( DDB_OPT_LOG_FD_DEVICE_TYPE, $this->device_type );

 		// 	// $this->ddboptlogger->set_field ( DDB_OPT_LOG_FD_LNG, $this->lng );
 		// 	// $this->ddboptlogger->set_field ( DDB_OPT_LOG_FD_LAT, $this->lat );
 		// 	// $this->ddboptlogger->set_field ( DDB_OPT_LOG_FD_CITY_CODE, $this->city_code );

 		// 	// $this->ddboptlogger->set_field ( DDB_OPT_LOG_FD_RET_CODE, $this->result ['ret'] );
 		// 	// $this->ddboptlogger->set_field ( DDB_OPT_LOG_FD_RET_MSG, $this->result ['msg'] );
 		// }
		
		// 释放连接
		if (! empty ( $this->mydb )) {
			foreach ( $this->mydb as $name => $db ) {
				$this->mydb [$name]->close ();
			}
		}
	}

	/**
	 * 解决 AJAX 的跨域问题
	 */
	public function _solve_cros_domain() {
		$http_origin = isset ( $_SERVER ['HTTP_ORIGIN'] ) ? $_SERVER ['HTTP_ORIGIN'] : '';

		// // 如果是 dadabus.com 域名下的站点
		// if (preg_match ( '/([0-9a-zA-Z_-]+.buskeji.com)$/', $http_origin ) || preg_match ( '/([0-9a-zA-Z_-]+.dadabus.com)$/', $http_origin )) {
		// 	// 解决跨域问题
		// 	header ( 'Access-Control-Allow-Origin: ' . $http_origin );
		// }

		// 支持所有域名访问
		header ( 'Access-Control-Allow-Origin: ' . $http_origin  );
		header ( 'Access-Control-Allow-Methods: GET,HEAD,PUT,POST,DELETE' );
		header ( 'Access-Control-Allow-Headers: x-token,content-type' );
	}
	
	/**
	 * 返回错误码json格式
	 * @param unknown $code
	 * @param string $message
	 */
	public function output_error($code, $message = null){
		if(empty($message)){
			$message = $this->result_config[$code];
		}
		
		$this->result ['ret'] = $code;
		$this->result ['msg'] = $message;
		$this->application->gri_output ( $this->result );
	}

	public function response_result($ret, $msg, $data = array(),$type = 'json') {
		$this->result ['ret'] = $ret;
		$this->result ['msg'] = $msg;
		$this->result ['data'] = $data;
		$this->application->gri_output ( $this->result,$type );
		exit ();
	}

	/**
	 * 登录key
	 * @param $uid
	 * @param $device_type
	 * @return string
	 */
	public function get_login_key($uid, $device_type)
	{
		if($device_type == 3)
		{
			$device_type = 'web';
		}
		if($device_type == 1 ||$device_type == 2)
		{
			$device_type = 'app';
		}
		$key = "boss_login_${uid}_${device_type}";
		return $key;
	}
	/* 旧版key public function get_login_key($uid, $device_type){
		$key = "boss_login_${uid}_${device_type}";
		return $key;
	}*/
	/**
	 * 忘记密码key
	 * @param unknown $mobile
	 * @return string
	 */
	public function get_forget_pwd_key($mobile){
		$key = "boss_forget_pwd_$mobile";
		return $key;
	}
	
	/**
	 * 手机验证码
	 * @param unknown $mobile
	 * @return string
	 */
	public function get_auth_code_key($mobile){
		$key = "boss_auth_code_$mobile";
		return $key;
	}

	/**
	 * 手机短信验证码
	 * @param unknown $mobile
	 * @return string
	 */
	public function get_verify_code_key($mobile){
		$key = "boss_verify_code_$mobile";
		return $key;
	}

	/**
	 * 包车报价
	 * @param $order_id
	 * @return string
	 */
	public function get_charter_quote_key($order_id){
		$key = 'boss_charter_quote_data_'.$order_id;
		return $key;
	}

	/**
	 * 获取日志类型
	 * @param $key_name
	 * @param $method_name
	 * @return string
	 */
	public function get_sys_log_guide_type($key_name,$method_name)
	{
		$this->load->config('system_log_tpl');
		$guide_content = $this->config->item('system_log_tpl');
		if (isset($guide_content[$key_name]['type_name']) && !empty($guide_content[$key_name]['type_name']) )
		{
			return $guide_content[$key_name]['type_name'];
		}
		return '未定义的类型。执行的类与方法：'.$method_name;
	}

	/**
	 * 检测登录
	 * 1、memcache可用，直接调token，检测是否相等
	 * 2、memcache不可用，按固定算法，检测token值
	 */
	public function check_login()
	{
		try
		{
			$key = $this->get_login_key($this->uid, $this->device_type);
			$ret = $this->get_session($key);

			if(empty($ret))
			{
				log_debug_message('exist login_data is empty');

				//检测是否memcache报错
				$last_error_code = $this->boss_memcached->m->getLastErrorCode();
				if(0 != $last_error_code)
				{
					$last_error_message = $this->boss_memcached->m->getLastErrorMessage();
					log_error_message('memcached get failed: last_error_code='. $last_error_code . '; last_error_message=' . $last_error_message);
					throw new Exception ( 'memcached fail' );
				}

				//确定服务是否正常
				$this->boss_memcached->set ( 'test', 'test' );
				$test = $this->boss_memcached->get ( 'test' );
				if(empty($test))
				{
					$last_result_code = $this->boss_memcached->m->getResultCode();
					$last_result_message = $this->boss_memcached->m->getResultMessage();
					log_error_message('memcached get failed: last_result_code='. $last_result_code . '; last_result_message=' . $last_result_message);
					throw new Exception ( 'memcached fail' );
				}

				$this->output_error(RET_LOGIN_TIMEOUT);
			}

			//由于IOS升级后，device_id变更，不做device_id判定
			if($ret['token'] != $this->token)
			{
				$this->output_error(RET_LOGIN_ERROR);
			}

			$this->user = $ret['user'];
			$this->mobile = $ret['user']['mobile'];

			//刷新session有效时间
			$this->set_session($key, $ret);
		}catch (Exception $e)
		{
			$user_info = M('mod_user')->get_by_id($this->uid);
			if(empty($user_info))
			{
				$this->result['ret'] = 9999;
				$this->result['message'] = '用户不存在';
				$this->application->gri_output($this->result);
			}
			$nonce = $this->nonce;
			$token = substr(md5 ( $user_info ['userPassword'].$nonce ),30).$nonce;
			if($token != $this->token)
			{
				$this->output_error(RET_LOGIN_ERROR);
			}

			$this->user = $user_info;
			$this->mobile = $user_info['mobile'];
		}
	}

	
	public function check_auth($auth){
		$auth_list = explode(',', $auth);
		$class = $this->uri->segments[1];
		$common_auth = array('common','passport');
		if(array_search($class, $common_auth)){
			return TRUE;
		}
		$class_to_auth = array(
				'1'=>array('admin','car_settle','car','chartered','company','driver','message','offline_order','operation_log','order','staff','schedule'),
				'2'=>array('car_settle'),
				'3'=>array('order','schedule','chartered'),
				'4'=>array('offline_order'),
		);
		
		foreach ($auth_list as $unit){
			if(array_search($class, $class_to_auth[$unit])){
				return TRUE;
			}
		}
		return FALSE;
	}

	/**
	 * 是否有访问权限
	 *
	 * @return boolean
	 */
	public function has_auth($auth_code = array(),$isMobile = FALSE) {
		$ret = FALSE;
		/*if($isMobile == TRUE){
			$user_info = $this->session->userdata ( LOGIN_MOBILE_SESSION_KEY );
		}else{
			$user_info = $this->session->userdata ( LOGIN_SESSION_KEY );
		}*/
		$user_info = $this->user;
		$auth_str = "";
		if (! empty ( $user_info )) {
			$ret = $this->check_has_auth ( $user_info ['userName'], $auth_code, $auth_str );
		}
		if ($ret == FALSE) {
			//$this->show_no_auth ( $auth_str );
			$this->result ['ret'] = - 403;
			$this->result ['msg'] = '你没有权限访问！请申请' . $auth_str . '权限';
			$this->result ['total'] = 0;
			$this->result ['rows'] = 0;
			$this->application->gri_output ( $this->result );
			return FALSE;
		}
		return $ret;
	}

	/**
	 * 检查是否有quan'xian
	 *
	 * @param unknown $user_name
	 * @param unknown $auth_code_arr
	 * @param string $auth_name_str
	 * @return boolean
	 */
	public function check_has_auth($user_name, $auth_code_arr = array(), &$auth_name_str = '') {
		$this->load->model ( 'mod_auth2' );
		$this->load->model ( 'mod_auth' );

		// 用户名为空
		if (empty ( $user_name )) {
			return FALSE;
		}
		// 获取权限信息
		$isAuth = $this->mod_auth->has_auth ( $user_name, $auth_code_arr );

		// 如果有已经有权限
		if (! empty ( $isAuth )) {
			return TRUE;
		}

		// 如果没有权限，组织需要的权限信息
		$auth_name_str = '';
		if (! empty ( $auth_code_arr ) && is_array ( $auth_code_arr )) {
			foreach ( $auth_code_arr as $code ) {
				$auth = $this->mod_auth2->get_auth_by_where ( array (
						'auth_code' => $code
				) );
				if (! empty ( $auth )) {
					$auth_name_str .= "【" . $auth ['auth_name'] . "】或";
				}
			}
		}
		if (! empty ( $auth_name_str )) {
			$auth_name_str = preg_replace ( "#或$#", "", $auth_name_str );
		}

		return FALSE;
	}

	/**
	 * 没有权限
	 */
	protected function show_no_auth($auth_name = '') {
		$header_info = getallheaders ();
		if (isset ( $_SERVER ["HTTP_X_REQUESTED_WITH"] ) && strtolower ( $_SERVER ["HTTP_X_REQUESTED_WITH"] ) == "xmlhttprequest") {
			$this->result ['ret'] = - 403;
			$this->result ['msg'] = '你没有权限访问！请申请' . $auth_name . '权限';
			$this->result ['total'] = 0;
			$this->result ['rows'] = 0;
			$this->application->gri_output ( $this->result );
		} else if (isset ( $header_info ['Content-Type'] ) && $header_info ['Content-Type'] == 'application/x-www-form-urlencoded') {
			$this->result ['ret'] = - 403;
			$this->result ['msg'] = '你没有权限访问！请申请' . $auth_name . '权限';
			$this->result ['total'] = 0;
			$this->result ['rows'] = 0;
			$this->application->gri_output ( $this->result, 'plain' );
		} else {
			$this->result ['ret'] = - 403;
			$this->result ['msg'] = '你没有权限访问！请申请' . $auth_name . '权限';
			$this->result ['total'] = 0;
			$this->result ['rows'] = 0;
			$this->application->gri_output ( $this->result );
			//redirect ( '/home/no_auth?auth_name=' . urlencode ( $auth_name ), TRUE );
		};
	}

	/**
	 * 获取会话信息
	 * @param unknown $key
	 * @return array $data
	 */
	public function get_session($key)
	{
		$this->load->library ( 'memcache', array (
				'config_file' => 'memcached',
				'config_key'  => 'boss_memcached'
		),'boss_memcached');
//		$this->load->library ( 'memcache' );
		$data = $this->boss_memcached->get ($key);
		if(empty($data)){
			return FALSE;
		}
		
		$data = json_decode($data, TRUE);
		return $data;
	}

	/**
	 * 清空会话信息
	 *
	 * @param unknown $key
	 */
	public function clean_session($key)
	{
		$this->load->library ( 'memcache', array (
				'config_file' => 'memcached',
				'config_key'  => 'boss_memcached'
		),'boss_memcached');
//		$this->load->library ( 'memcache' );
		$ret = $this->boss_memcached->delete ($key);
		return $ret;
	}


	/**
	 * 设置会话信息
	 * @param $key
	 * @param $data
	 * @param int $expires_in
	 * @return mixed
	 */
	public function set_session($key, $data, $expires_in = 604800){
		$this->load->library ( 'memcache', array (
				'config_file' => 'memcached',
				'config_key'  => 'boss_memcached'
		),'boss_memcached');
//		$this->load->library ( 'memcache' );
		if(is_array($data)){
			$data = json_encode($data);
		}
		$ret = $this->boss_memcached->set ( $key, $data, $expires_in);
		return $ret;
	}

	/**
	 * * 获取memcached连接状态
	 * @return integer status
	 *              0 - 连接成功；其他 - 连接失败
	 * @return int
	 * @throws Exception
	 */
	public function get_memcached_status()
	{
		$this->load->library ( 'memcache', array (
				'config_file' => 'memcached',
				'config_key'  => 'boss_memcached'
		),'boss_memcached');
//		$this->load->library ( 'memcache' );

		//确定服务是否正常
		$this->boss_memcached->set ( 'test', 'test' );
		$test = $this->boss_memcached->get ( 'test' );
		if(empty($test))
		{
			$last_error_code = $this->boss_memcached->m->getLastErrorCode();
			if(0 != $last_error_code)
			{
				$last_error_message = $this->boss_memcached->m->getLastErrorMessage();
				log_error_message('memcached get failed: last_error_code='. $last_error_code . '; last_error_message=' . $last_error_message);
				return FALSE;
			}
		}

		return TRUE;
	}
	
	
	/**
	 * 获取POST参数
	 *
	 * @param unknown $key        	
	 * @param string $default        	
	 * @return unknown|Ambigous <string, unknown>
	 */
	public function parse_post($key, $default = "") {
		
		// 第二个参数防止xss过滤
		$val = $this->input->post ( $key, TRUE );
		
		if ($val === '0' or $val === 0) {
			return $val;
		}
		
		if(empty($val)){
			return $this->input->get ( $key, TRUE );
		}
		
		return $val ? $val : $default;
	}
	
	/**
	 * 获取GET参数
	 *
	 * @param unknown $key        	
	 * @param string $default        	
	 * @return unknown|Ambigous <string, unknown>
	 */
	public function parse_get($key, $default = "") {
		
		// 第二个参数防止xss过滤
		$val = $this->input->get ( $key, TRUE );
		
		if ($val === '0' or $val === 0) {
			return $val;
		}
		
		return $val ? $val : $default;
	}

	/**
	 * @param $key
	 * @param string $default
	 * @return string
	 */
	public function parse_request($key, $default = "")
	{
		// 第二个参数防止xss过滤
		$val = $this->input->get_post ( $key, TRUE );
		if ($val === '0' or $val === 0) {
			return $val;
		}

		return $val ? $val : $default;
	}
	
	/**
	 * 设置输出结果
	 *
	 * @param unknown $ret
	 * @param unknown $msg
	 * @param unknown $data
	 */
	public function set_result($ret, $msg, $data = array()) {
		$this->result ['ret'] = $ret;
		$this->result ['msg'] = $msg;
		if (is_array ( $data ) and ! empty ( $data )) {
			$this->result ['data'] = $data;
		}
	}
	
	/**
	 * ip限制
	 */
	public function ip_limit($method, $limit = 100, $time = 3600){
		$ip = $_SERVER ['REMOTE_ADDR'] ;
		$key = "che_limit_".$ip."_".$method;
		//TODO:需要修改memcache加载方式
		$this->load->library ( 'memcache' );
		$count = $this->memcache->get ( $key );
		if(empty($count)){
			$count = 0;
		}
		
		if($count > $limit){
			return FALSE;
		}
		
		$ret = $this->memcache->set ( $key, $count++, $time );
		return true;
	}
	
	/**
	 * 手机号限制
	 */
	public function mobile_limit($mobile, $method, $limit = 100, $time = 3600){
		$key = "che_limit_".$mobile."_".$method;
		//TODO:需要修改memcache加载方式
		$this->load->library ( 'memcache' );
		$count = $this->memcache->get ( $key );
		if(empty($count)){
			$count = 0;
		}
	
		if($count > $limit){
			return FALSE;
		}
	
		$ret = $this->memcache->set ( $key, $count++, $time );
		return true;
	}
}
