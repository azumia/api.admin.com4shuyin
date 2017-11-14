<?php

function datelist2range($date_list){
	$date_map = array();
	foreach ($date_list as $idx=>$unit){
		$unit = date('Ymd', strtotime($unit));
		$date_list[$idx] = $unit;
		$date_map[$unit] = 1;
	}
		
	sort($date_list);
	$start_time = strtotime($date_list[0]);
	
	$start_date = $date_list[0];
	$end_date = $date_list[count($date_list) - 1];
	$date_range_list = array();
	while (true){
		$start_time += 24*3600;
		if(date('Ymd', $start_time) > $end_date){
			$date_range_list[] = array(
					'start_date'=>$start_date,
					'end_date'=>$end_date
			);
			break;
		}
	
		if(isset($date_map[date('Ymd', $start_time)])){
			if(empty($start_date)){
				$start_date = date('Ymd', $start_time);
			}
		}else{
			if(empty($start_date)){
				continue;
			}
			$date_range_list[] = array(
					'start_date'=>$start_date,
					'end_date'=>date('Ymd', $start_time - 24*3600)
			);
			$start_date = null;
		}
	}
	return $date_range_list;
}
if (! function_exists ( 'int2time' )) {
	function int2time($time) {
		$len =  6 - strlen ( $time );
		for($i = 0; $i < $len; $i ++) {
			$time = '0' . $time;
		}
		return  date ( 'H:i:s', strtotime ( '2016-01-01 ' . $time ) );
	}
}
if (! function_exists ( 'get_bit_from_int' )) {

	/**
	 * 从10进制数字中获取其二进制中某一位的值
	 *
	 * @param unknown $int_value
	 *        	10进制数字
	 * @param unknown $bit_index
	 *        	二进制位置，从低位到高位算起，第一位为 1 ，以此类推
	 * @return number 返回 0 或者 1
	 */
	function get_bit_from_int($int_value, $bit_index) {
		$bit_str = decbin ( $int_value );
		$bit_len = strlen ( $bit_str );

		if ($bit_len < $bit_index) {
			return 0;
		}

		$bit = substr ( $bit_str, $bit_len - $bit_index, 1 );
		if ($bit == 0) {
			return 0;
		}

		return 1;
	}
}
if (! function_exists ( 'time2int' )) {
	function time2int($time) {
		$arr = explode(':', $time);
		if(count($arr) != 3){
			return FALSE;
		}
		
		if(intval($arr[0]) < 0 || intval($arr[0]) > 23){
			return FALSE;
		}
		
		if(intval($arr[1]) < 0 || intval($arr[1]) > 59){
			return FALSE;
		}
		
		if(intval($arr[1]) < 0 || intval($arr[1]) > 59){
			return FALSE;
		}
		return $arr[0].$arr[1].$arr[2];
	}
}




if (! function_exists ( 'fen2yuan' )) {
	function fen2yuan($fen) {
		if (! is_numeric ( $fen )) {
			return FALSE;
		}

		if (strlen ( $fen ) >= 3) {
			return substr ( $fen, 0, strlen ( $fen ) - 2 ) . "." . substr ( $fen, - 2 );
		} else if (strlen ( $fen ) == 2) {
			return "0." . $fen;
		} else if (strlen ( $fen ) == 1) {
			return "0.0" . $fen;
		}
	}
}

/*
 * help帮助函数库
 *
 * @author daniel
 */
/*
 * 将元转成分的整数值，例如：3.656，会转成365
 */
if (! function_exists ( 'yuan2fen' )) {
	function yuan2fen($yuan) {
		if (! is_numeric ( $yuan )) {
			return FALSE;
		}

		// 如果没有小数点,直接在后面添加两个'0'

		if ($yuan == 0) {
			return intval ( 0 );
		} else {
			$res = explode ( ".", $yuan );
			$int_val = $res [0];
			$decimal_val = isset ( $res [1] ) ? $res [1] : 0;
			$decimal_val .= '00';
				
			$result = '';
			// 如果整数部分只有一个0,取两个小数部分作为结果
			if ($int_val == '0') {
				$result = substr ( $decimal_val, 0, 2 );
			} else {
				$result = $int_val . substr ( $decimal_val, 0, 2 );
			}
				
			return intval ( $result );
		}
	}
}
if (! function_exists ( 'gen_ticket_identifier' )) {
	function gen_ticket_identifier($toget_line_id, $start_date, $seat_number) {
		$CI = & get_instance ();

		$CI->load->config ( 'ticket_identifier' );
		$ticket_identifier_arr = $CI->config->item ( 'ticket_identifier' );

		$ret = $toget_line_id + $seat_number + intval ( $start_date );
		$ret = $ret % 9000;

		return $ticket_identifier_arr [$ret];
	}
}

if (! function_exists ( 'gen_ticket_code' )) {
    function gen_ticket_code($toget_line_id, $start_date) {
        return md5 ( $toget_line_id . $start_date . 'adfd676hio$%^nhiaydfd' );
    }
}

if (! function_exists ( 'get_bit_from_int' )) {

	/**
	 * 从10进制数字中获取其二进制中某一位的值
	 * @param unknown $int_value  10进制数字
	 * @param unknown $bit_index  二进制位置，从低位到高位算起，第一位为 1 ，以此类推
	 * @return number 返回 0 或者 1
	 */
	function get_bit_from_int($int_value, $bit_index) {
		$bit_str = decbin ( $int_value );
		$bit_len = strlen ( $bit_str );

		if ($bit_len < $bit_index) {
			return 0;
		}

		$bit = substr ( $bit_str, $bit_len - $bit_index, 1 );
		if ($bit == 0) {
			return 0;
		}

		return 1;
	}
}

if (! function_exists ( 'set_bit_to_int' )) {

	/**
	 * 设置 10 进制转化为 2 进制后某一位的值，并返回对应的 10 进制值
	 * @param unknown $int_value  10 进制数字
	 * @param unknown $bit_value  要设置的二进制值：0或者1
	 * @param unknown $bit_index  二进制位置，从低位到高位算起，第一位为 1 ，以此类推
	 * @return unknown|number     返回设置后的10进制值
	 */
	function set_bit_to_int($int_value, $bit_value,$bit_index) {
		$bit_str = decbin ( $int_value );

		if ($bit_index < 1) {
			return $int_value;
		}

		// 如果设置指定位为 1
		if ($bit_value == 1) {
			$tmp = 1;
			if ($bit_index > 1) {
				$tmp = $tmp << ($bit_index - 1);
			}

			return ($int_value | $tmp);
		}

		// 如果设置指定位为 0
		$i = 1;
		$tmp = '';
		while ( $i <= strlen ( $bit_str ) ) {
			if ($i == $bit_index) {
				$tmp = '0' . $tmp;
			} else {
				$tmp = '1' . $tmp;
			}
			$i ++;
		}

		$tmp = bindec ( $tmp );
		return ($int_value & $tmp);
	}
}

// 获取随机字符串
if (! function_exists ( 'get_rand_string' )) {
	/**
	 * 获取随机字符串
	 *
	 * @param int $length
	 *        	要获取的长度 默认为4位
	 * @param int $type
	 *        	随机数类型 默认为0表示数字 1-大小写字母 2-大写字母 3-小写字母 4-大写字母和数字
	 *
	 * @return 指定的随机字符串
	 */
	function get_rand_string($length = 4, $type = 0) {
		$str = '';
		switch ($type) {
			default :
				$chars = str_repeat ( '123456789', 3 );
				break;
			case 1 :
				$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
				break;
			case 2 :
				$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
				break;
			case 3 :
				$chars = 'abcdefghijklmnopqrstuvwxyz';
				break;
			case 4 :
				$chars = 'A1BC2DE3FG4HI5JK6LMNOPQ7RSTU8VWX9YZ';
				break;
			case 5 :
				$chars = 'abcdefghijkmnpqrstuvwxyz23456789';
				break;
		}
		$chars = str_shuffle ( $chars );
		$str = substr ( $chars, 0, $length );
		return $str;
	}
}



if (! function_exists ( 'convert_scope_to_bit' )) {
	function convert_scope_to_bit($scope) {
		$value = 0;
		if (! is_array ( $scope )) {
			$scope = explode ( ',', $scope );
		}
		
		foreach ( $scope as $unit ) {
			if(!is_numeric($unit)){
				throw new Exception(" scope $unit 格式错误");
			}
			$value += pow ( 2, ($unit - 1) );
		}
		return $value;
	}
}

if (! function_exists ( 'convert_bit_to_scope' )) {
	function convert_bit_to_scope($scope) {
		$bit = base_convert ( $scope, 10, 2 );
		
		$value = '';
		if (empty ( $bit )) {
			return $value;
		}
		
		while ( true ) {
			$len = strlen ( strval ( $bit ) );
			$a = pow ( 10, $len - 1 );
			if (intval($bit / $a) == 1) {
				$value .= $len . ',';
			}
			
			if ($bit < 10) {
				break;
			}
			
			$bit -= $a;
		}
		
		return $value;
	}
}

if (! function_exists ( 'check_mobile' )) {
	function check_mobile($mobile) {
		return strlen ( $mobile ) == 11;
	}
}

if (! function_exists ( 'check_card' )) {
	function check_card($card) {
		if(strlen ( $card ) != 18){
			return FALSE;
		}
		
		$a = str_split($card, 1);
		$w = array(7,9,10,5,8,4,2,1,6,3,7,9,10,5,8,4,2);
		$c = array(1,0,'X',9,8,7,6,5,4,3,2);
		
		$sum = 0;
		for ($i=0;$i<17;$i++){
			$sum += $a[$i]*$w[$i];
		}
		
		$r = $sum%11;
		$res = $c[$r];
		return $res == 	$a[17];
	}
}

if (! function_exists ( 'check_sex' )) {
	function check_sex($card, $sex) {
		$str = substr($card, 14, 3);
		
		$num = $str % 2;
		if($num == 0){
			$num = 2;
		}		
		
		return $num == $sex;
	}
}

if (! function_exists ( 'check_birthday' )) {
	function check_birthday($card, $birthday) {
		$str = substr($card, 6, 8);
		$birthday = date('Ymd', strtotime($birthday));
		return $str == $birthday;
	}
}

if (! function_exists ( 'check_company_code' )) {
	function check_company_code($company_code) {
		return strlen ( $company_code ) == 16;
	}
}
if (! function_exists ( 'check_time_less_curr' )) {
	function check_time_less_curr($date){
		$time  = strtotime($date);
		if($time < strtotime(date('Y-m-d'))){
			return TRUE;
		}
		
		return FALSE;
	}
}

if (! function_exists ( 'check_date_range' )) {
	function check_date_range($start_date, $end_date, $date){
		$time  = strtotime($date);
		
		$start_time = strtotime($start_date);
		$end_time = 0;
		
		if(!empty($end_date)){
			$end_time = strtotime($end_date);
		}
		
		
		if($time < $start_time){
			return FALSE;
		}
		
		if($time > $end_time && $end_time != 0){
			return FALSE;
		}

		return TRUE;
	}
}
if (! function_exists ( 'check_date_list_range' )) {
	function check_date_list_range($start_date, $end_date, $date_list){

		$start_time = strtotime($start_date);
		$end_time = 0;

		if(!empty($end_date)){
			$end_time = strtotime($end_date);
		}
		foreach ($date_list as $date){
			$time  = strtotime($date);
			if($time < $start_time){
				return FALSE;
			}
	
			if($time > $end_time && $end_time != 0){
				return FALSE;
			}
		}
		return TRUE;
	}
}
if (! function_exists ( 'check_date_list_month_range' )) {
	function check_date_list_month_range($month, $date_list){
		foreach ($date_list as $date){
			$m = date('Ym', strtotime($date));
			if($m != $month){
				return FALSE;
			}
		}
		return TRUE;
	}
}

if (! function_exists ( 'check_start_end_date' )) {
	function check_start_end_date($start_date, $end_date){
		$start_time = strtotime($start_date);
		$end_time = 0;

		if(!empty($end_date)){
			$end_time = strtotime($end_date);
		}


		if($end_time < $start_time && $end_time != 0){
			return FALSE;
		}

		return TRUE;
	}
}


if (! function_exists ( 'gen_order_code' )) {
	function gen_order_code($line_id) {
		$date = date ( 'Ymd' );
		
		$line_id = strval ( $line_id );
		
		for($i = 0; $i < 8 - strlen ( $line_id ); $i ++) {
			$line_id = '0' . $line_id;
		}
		
		$rand = rand ( 10000000, 99999999 );
		return $date . $line_id . $rand;
	}
}
if (! function_exists ( 'gen_ticket_color' )) {
	function gen_ticket_color() {
		$color_arr = array (
				'#eacd76',
				'#ff461f',
				'#70f3ff',
				'#d3b17d',
				'#ff4777',
				'#44cef6',
				'#e29c45',
				'#ffb3a7',
				'#3eede7',
				'#bce672',
				'#eaff56',
				'#b0a4e3',
				'#9ed048',
				'#fff143',
				'#cca4e3',
				'#00bc12',
				'#faff72',
				'#e4c6d0',
				'#7fecad',
				'#ffc64b',
				'#c0ebd7',
				'#d9b611' 
		);
		
		$len = count ( $color_arr );
		$rand = rand ( 0, $len - 1 );
		return $color_arr [$rand];
	}
}
if (! function_exists ( 'M' )) {
	function M($model) {
		$CI = & get_instance ();
		$CI->load->model ( $model );
		
		$models = explode ( '/', $model );
		$instanceName = $models [count ( $models ) - 1];
		return $CI->$instanceName;
	}
}

if (! function_exists ( 'L' )) {
	function L($library) {
		$CI = & get_instance ();
		$CI->load->library ( $library );
		
		$libraries = explode ( '/', $library );
		$instanceName = $libraries [count ( $libraries ) - 1];
		$instanceName = strtolower ( $instanceName );
		return $CI->$instanceName;
	}
}
if (! function_exists ( 'V' )) {
	function V($view, $data = array(), $isReturn = FALSE) {
		$CI = & get_instance ();
		return $CI->load->view ( $view, $data, $isReturn );
	}
}

if (! function_exists ( 'gen_password' )) {
	function gen_password($len) {
		$arr = str_split ( 'abcdefhijnrfjACDEFGHJNQRFJ345678' );
		$password = '';
		for($i = 0; $i < $len; $i ++) {
			$password .= $arr [rand ( 0, count ( $arr ) - 1 )];
		}
		return $password;
	}
}

// 以时间为基础，生成一个18位的唯一数字
if (! function_exists ( 'create_unique_number' )) {
	
	/**
	 * 以时间为基础，生成一个18位的唯一数字
	 *
	 * @return string
	 */
	function create_unique_number() {
		$pre = date ( 'YmdHis' );
		$rand = sprintf ( '%04d', rand ( 1, 9999 ) );
		
		return $pre . $rand;
	}
}

// GCJ-02 to DB-09 国标经纬度转化成百度经纬度
if (! function_exists ( 'convert_to_bd_gps' )) {
	function convert_to_bd_gps($gg_lat = 0, $gg_lon = 0) {
		return array (
				'lng' => $gg_lon,
				'lat' => $gg_lat 
		);
		
		$x_pi = 3.14159265358979324 * 3000.0 / 180.0;
		$x = $gg_lon;
		$y = $gg_lat;
		$z = sqrt ( $x * $x + $y * $y ) + 0.00002 * sin ( $y * $x_pi );
		$theta = atan2 ( $y, $x ) + 0.000003 * cos ( $x * $x_pi );
		$bd_lon = $z * cos ( $theta ) + 0.0065;
		$bd_lat = $z * sin ( $theta ) + 0.006;
		return array (
				'lng' => $bd_lon,
				'lat' => $bd_lat 
		);
	}
}

// DB-09 to GCJ-02 百度经纬度转化成国标经纬度
if (! function_exists ( 'convert_from_bd_gps' )) {
	function convert_from_bd_gps($bd_lat, $bd_lon) {
		return array (
				'lng' => $bd_lon,
				'lat' => $bd_lat 
		);
		
		$x_pi = 3.14159265358979324 * 3000.0 / 180.0;
		$x = $bd_lon - 0.0065;
		$y = $bd_lat - 0.006;
		$z = sqrt ( $x * $x + $y * $y ) - 0.00002 * sin ( $y * $x_pi );
		$theta = atan2 ( $y, $x ) - 0.000003 * cos ( $x * $x_pi );
		$gg_lon = $z * cos ( $theta );
		$gg_lat = $z * sin ( $theta );
		return array (
				'lng' => $gg_lon,
				'lat' => $gg_lat 
		);
	}
}

// 将秒数转化为*天*时*分*秒的格式
if (! function_exists ( 'format_as_time_span' )) {
	function format_as_time_span($time) {
		$result = '';
		$time = intval ( $time );
		if ($time >= 86400) {
			$result .= floor ( $time / 86400 ) . '天';
			$time = $time % 86400;
		}
		
		if ($time >= 3600) {
			$result .= floor ( $time / 3600 ) . '小时';
			$time = $time % 3600;
		}
		
		if ($time >= 60) {
			$result .= floor ( $time / 60 ) . '分钟';
			$time = $time % 60;
		}
		
		if ($time < 0) {
			$time = 0;
		}
		
		$result .= $time . '秒';
		
		return $result;
	}
}

// 计算两点的距离
if (! function_exists ( 'get_gps_distance' )) {
	/**
	 *
	 * 计算两点之间的距离,单位：米
	 *
	 * @param unknown $lng1
	 *        	经度1
	 * @param unknown $lat1
	 *        	纬度2
	 * @param unknown $lng2
	 *        	经度2
	 * @param unknown $lat2
	 *        	纬度2
	 * @return number
	 */
	function get_gps_distance($lng1, $lat1, $lng2, $lat2) {
		// 将角度转为狐度
		$radLat1 = @deg2rad ( $lat1 ); // deg2rad()函数将角度转换为弧度
		$radLat2 = @deg2rad ( $lat2 );
		$radLng1 = @deg2rad ( $lng1 );
		$radLng2 = @deg2rad ( $lng2 );
		$a = $radLat1 - $radLat2;
		$b = $radLng1 - $radLng2;
		$s = 2 * asin ( sqrt ( pow ( sin ( $a / 2 ), 2 ) + cos ( $radLat1 ) * cos ( $radLat2 ) * pow ( sin ( $b / 2 ), 2 ) ) ) * 6378.137 * 1000;
		
		return ceil ( $s );
	}
}

// 根据经纬度，获得当前位置指定半径圆外切矩形的四个点坐标
if (! function_exists ( 'get_near_position' )) {
	/**
	 * 根据经纬度，获得当前位置指定半径圆外切矩形的四个点坐标
	 *
	 * @param unknown $lng
	 *        	地理经度
	 * @param unknown $lat
	 *        	地理纬度
	 * @param number $raidus
	 *        	半径，单位(米)
	 * @return multitype:multitype:string multitype:number
	 */
	function get_near_position($lng, $lat, $raidus = 1000) {
		$raidus = intval ( $raidus );
		if ($raidus <= 0) {
			$raidus = 200;
		}
		$PI = 3.14159265;
		$latitude = $lat;
		$longitude = $lng;
		$degree = (24901 * 1609) / 360.0;
		$raidusMile = $raidus;
		$dpmLat = 1 / $degree;
		$radiusLat = $dpmLat * $raidusMile;
		$minLat = $latitude - $radiusLat;
		$maxLat = $latitude + $radiusLat;
		$mpdLng = $degree * cos ( $latitude * ($PI / 180) );
		$dpmLng = 1 / $mpdLng;
		$radiusLng = $dpmLng * $raidusMile;
		$minLng = $longitude - $radiusLng;
		$maxLng = $longitude + $radiusLng;
		if ($minLat > $maxLat) {
			$temp = $minLat;
			$minLat = $maxLat;
			$maxLat = $temp;
		}
		if ($minLng > $maxLng) {
			$temp = $minLng;
			$minLng = $maxLng;
			$maxLng = $temp;
		}
		$result = array ();
		$result ['lng'] = array (
				'min' => $minLng,
				'max' => $maxLng 
		);
		$result ['lat'] = array (
				'min' => $minLat,
				'max' => $maxLat 
		);
		return $result;
	}
}

// 手机号格式验证
if (! function_exists ( 'mobile_code_varify' )) {
	/**
	 * 手机号码格式验证
	 *
	 * @param unknown $mobile        	
	 * @return boolean
	 */
	function mobile_code_varify($mobile) {
		$mobile = trim ( $mobile );
		if (empty ( $mobile ) or strlen ( $mobile ) !== 11) {
			return FALSE;
		}
		
		if (preg_match ( "/1[23456789]{1}\d{9}$/", $mobile )) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}

// 过滤DB敏感字符
if (! function_exists ( 'db_string_filter' )) {
	/**
	 * 过滤DB敏感字符
	 *
	 * @param unknown $str        	
	 * @return mixed
	 */
	function db_string_filter($str) {
		$pattern = "/'|_|%/";
		$replacement = '';
		$res = preg_replace ( $pattern, $replacement, $str );
		return $res;
	}
}

// 获取随机字符串
if (! function_exists ( 'get_rand_string' )) {
	/**
	 * 获取随机字符串
	 *
	 * @param int $length
	 *        	要获取的长度 默认为4位
	 * @param int $type
	 *        	随机数类型 默认为0表示数字 1-大小写字母 2-大写字母 3-小写字母 4-大写字母和数字
	 *        	
	 * @return 指定的随机字符串
	 */
	function get_rand_string($length = 4, $type = 0) {
		$str = '';
		switch ($type) {
			default :
				$chars = str_repeat ( '123456789', 3 );
				break;
			case 1 :
				$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
				break;
			case 2 :
				$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
				break;
			case 3 :
				$chars = 'abcdefghijklmnopqrstuvwxyz';
				break;
			case 4 :
				$chars = 'A1BC2DE3FG4HI5JK6LMNOPQ7RSTU8VWX9YZ';
				break;
		}
		$chars = str_shuffle ( $chars );
		$str = substr ( $chars, 0, $length );
		return $str;
	}
}

// 截取字符串,显示省略号
if (! function_exists ( 'cut_str' )) {
	
	/**
	 * [discuz] 基于PHP没有安装 mb_substr 等扩展截取字符串，如果截取中文字则按2个字符计算
	 *
	 * @param $string 要截取的字符串        	
	 * @param $length 要截取的字符数        	
	 * @param $dot 替换截掉部分的结尾字符串        	
	 * @return 返回截取后的字符串
	 */
	function cut_str($string, $length = 20, $dot = '...') {
		// 如果字符串小于要截取的长度则直接返回
		// 此处使用strlen获取字符串长度有很大的弊病，比如对字符串“新年快乐”要截取4个中文字符，
		// 那么必须知道这4个中文字符的字节数，否则返回的字符串可能会是“新年快乐...”
		if (strlen ( $string ) <= $length) {
			return $string;
		}
		// 转换原字符串中htmlspecialchars
		$pre = chr ( 1 );
		$end = chr ( 1 );
		$string = str_replace ( array (
				'&',
				'"',
				'<',
				'>' 
		), array (
				$pre . '&' . $end,
				$pre . '"' . $end,
				$pre . '<' . $end,
				$pre . '>' . $end 
		), $string );
		$strcut = ''; // 初始化返回值
		              // 如果是utf-8编码(这个判断有点不全,有可能是utf8)
		              
		// 初始连续循环指针$n,最后一个字位数$tn,截取的字符数$noc
		$n = $tn = $noc = 0;
		while ( $n < strlen ( $string ) ) {
			$t = ord ( $string [$n] );
			if ($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
				// 如果是英语半角符号等,$n指针后移1位,$tn最后字是1位
				$tn = 1;
				$n ++;
				$noc ++;
			} elseif (194 <= $t && $t <= 223) {
				// 如果是二字节字符$n指针后移2位,$tn最后字是2位
				$tn = 2;
				$n += 2;
				$noc += 2;
			} elseif (224 <= $t && $t <= 239) {
				// 如果是三字节(可以理解为中字词),$n后移3位,$tn最后字是3位
				$tn = 3;
				$n += 3;
				$noc += 2;
			} elseif (240 <= $t && $t <= 247) {
				$tn = 4;
				$n += 4;
				$noc += 2;
			} elseif (248 <= $t && $t <= 251) {
				$tn = 5;
				$n += 5;
				$noc += 2;
			} elseif ($t == 252 || $t == 253) {
				$tn = 6;
				$n += 6;
				$noc += 2;
			} else {
				$n ++;
			}
			// 超过了要取的数就跳出连续循环
			if ($noc >= $length) {
				break;
			}
		}
		// 这个地方是把最后一个字去掉,以备加$dot
		if ($noc > $length) {
			$n -= $tn;
		}
		$strcut = substr ( $string, 0, $n );
		
		// 再还原最初的htmlspecialchars
		$strcut = str_replace ( array (
				$pre . '&' . $end,
				$pre . '"' . $end,
				$pre . '<' . $end,
				$pre . '>' . $end 
		), array (
				'&',
				'"',
				'<',
				'>' 
		), $strcut );
		$pos = strrpos ( $strcut, chr ( 1 ) );
		if ($pos !== false) {
			$strcut = substr ( $strcut, 0, $pos );
		}
		if ($strcut == $string) {
			$return = $strcut;
		} else {
			$strcut = $strcut . $dot;
		}
		return $strcut; // 最后把截取加上$dot输出
	}
}

// 模拟POST请求
if (! function_exists ( 'sock_post' )) {
	/**
	 * 模拟post请求
	 *
	 * @param unknown $url        	
	 * @param unknown $query        	
	 * @param unknown $port        	
	 * @return string
	 */
	function sock_post($url, $query, $port) {
		$result = '';
		
		$info = parse_url ( $url );
		
		$fp = fsockopen ( $info ["host"], intval ( $port ), $errno, $errstr, 3 );
		$head = "POST " . $info ['path'] . " HTTP/1.0\r\n";
		$head .= "Host: " . $info ['host'] . "\r\n";
		$head .= "Content-type: application/x-www-form-urlencoded\r\n";
		$head .= "Content-Length: " . strlen ( trim ( $query ) ) . "\r\n";
		$head .= "\r\n";
		$head .= trim ( $query );
		$write = fputs ( $fp, $head );
		while ( ! feof ( $fp ) ) {
			$line = fread ( $fp, 4096 );
			$result .= $line;
		}
		return $result;
	}
}

if (! function_exists ( 'formatter_tpl' )) {
	function formatter_tpl($tpl_id, $params) {
		$CI = & get_instance ();
		$CI->load->config ( 'msg_tpl' );
		$msg_tpl_arr = $CI->config->item ( 'sms_tpl' );
		
		if (! is_array ( $params )) {
			$params = array ();
		}
		$msg_tpl = $msg_tpl_arr [$tpl_id];
		foreach ( $params as $k => $v ) {
			$msg_tpl = str_replace ( '#' . $k . '#', $v, $msg_tpl );
		}
		
		return $msg_tpl;
	}
}

/**
 * @desc  检查sql select 语句的执行结果, 失败时有的返回false, 有的返回空数组,此处封转利于维护和扩展
 * @param $sql_info
 */
if (! function_exists ( 'check_sql_select_result' )) {
	function check_sql_select_result($sql_info){
		if(!$sql_info) return false;
		if(is_array($sql_info) && count($sql_info) >=1 ){
			return true;
		}
		return false;
	}
}

//获取客户端ip地址
if (! function_exists ( 'get_client_ip' )) {
	function get_client_ip()
	{
		if ($_SERVER['REMOTE_ADDR']) {
			$cip = $_SERVER['REMOTE_ADDR'];
		} else {
			$cip = "unknown";
		}
		return $cip;
	}
}

if (! function_exists ( 'formatter_mobile' )) {
    function formatter_mobile($mobile) {
        if (empty ( $mobile )) {
            return $mobile;
        }
        return substr ( $mobile, 0, 3 ) . '****' . substr ( $mobile, 7, 4 );
    }
}

/**
 * excel 导出 公共方法
 *
 * @param $options $options['file_name']
 *        	string 给excel文件命名
 *        	$options['field'] array 给excel表定义字段
 *        	$options['keys'] array key的名称
 *        	$options['rows'] array 要加载的集合
 *
 * @throws PHPExcel_Exception
 * @throws PHPExcel_Reader_Exception
 */
function excelExport($options) {
	require ($_SERVER ['DOCUMENT_ROOT'] . "/libraries/PHPExcel/IOFactory.php");
	$objPHPExcel = new PHPExcel ();
	$file_name = ! empty ( $options ['file_name'] ) ? $options ['file_name'] : '新建文件';
	$objPHPExcel->getProperties ()->setTitle ( $file_name )->setDescription ( 'none' );
	$objPHPExcel->setActiveSheetIndex ( 0 );
	$row = 1;
	$letter = array (
			'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z' ,
			'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL',
			'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ'
	);
	foreach ( $options ['field'] as $k => $v ) {
		$objPHPExcel->getActiveSheet ()->setCellValueExplicit ( $letter [$k] . $row, $v, PHPExcel_Cell_DataType::TYPE_STRING );
	}
	$row ++;

	if (! empty ( $options ['rows'] )) {
		$count = 0;
		foreach ( $options ['rows'] as $k => $v ) {
			$sub_count = 0;
			foreach ( $options ['keys'] as $ele ) {
				$objPHPExcel->getActiveSheet ()->setCellValueExplicit ( $letter [$sub_count] . $row, $options ['rows'] [$count] [$ele], PHPExcel_Cell_DataType::TYPE_STRING );
				$sub_count ++;
			}
			$row ++;
			$count ++;
		}
	}
	$objPHPExcel->getActiveSheet ()->getStyle ( 'A4' )->getAlignment ()->setWrapText ( true );
	$objPHPExcel->setActiveSheetIndex ( 0 );
	$objWriter = IOFactory::createWriter ( $objPHPExcel, 'Excel5' );
	header ( 'Content-Type: application/vnd.ms-excel' );
	header ( 'Content-Disposition: attachment;filename="' . $file_name . '.xls"' );
	header ( 'Cache-Control: max-age=0' );
	$objWriter->save ( 'php://output' );
}

?>