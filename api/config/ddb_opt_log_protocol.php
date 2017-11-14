<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

// 运营日志字段定义
define ( 'DDB_OPT_LOG_FD_USER_ID', 'user_id' );
define ( 'DDB_OPT_LOG_FD_MOBILE', 'mobile' );
define ( 'DDB_OPT_LOG_FD_OPEN_ID', 'open_id' );
define ( 'DDB_OPT_LOG_FD_DEVICE_ID', 'device_id' );
define ( 'DDB_OPT_LOG_FD_DEVICE_TYPE', 'device_type' );
define ( 'DDB_OPT_LOG_FD_LOGIN_TYPE', 'login_type_desc' );
define ( 'DDB_OPT_LOG_FD_VERSION', 'version' );

define ( 'DDB_OPT_LOG_FD_LAT', 'lat' );
define ( 'DDB_OPT_LOG_FD_LNG', 'lng' );
define ( 'DDB_OPT_LOG_FD_CITY_CODE', 'city_code' );

define ( 'DDB_OPT_LOG_FD_RET_CODE', 'ret_code' );
define ( 'DDB_OPT_LOG_FD_RET_MSG', 'ret_msg' );

// 运营日志协议号定义
define ( 'DDB_OPT_LOG_ID_COMM', 10000 );
define ( 'DDB_OPT_LOG_ID_ORDER', 10001 );

// 运营日志协议定义
$DDB_OPT_LOG_PROTOCOL_COMM = array (
		DDB_OPT_LOG_FD_VERSION,
		DDB_OPT_LOG_FD_RET_CODE,
		DDB_OPT_LOG_FD_RET_MSG,
		DDB_OPT_LOG_FD_USER_ID,
		DDB_OPT_LOG_FD_MOBILE,
		DDB_OPT_LOG_FD_DEVICE_ID,
		DDB_OPT_LOG_FD_OPEN_ID,
		DDB_OPT_LOG_FD_DEVICE_TYPE,
		DDB_OPT_LOG_FD_LOGIN_TYPE,
		DDB_OPT_LOG_FD_LAT,
		DDB_OPT_LOG_FD_LNG,
		DDB_OPT_LOG_FD_CITY_CODE
);
?>
