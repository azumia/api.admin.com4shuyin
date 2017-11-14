<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => '123.207.67.19',
	'username' => 'root',
	'password' => 'CcK~6QU!G#C^JAcyb*RR',
	'database' => 'shuyin',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => TRUE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

// $active_group = 'default';
// $active_record = TRUE;
// $db['default']['hostname'] = 'rdsr86cnr0mpteq29689.mysql.rds.aliyuncs.com:3306';
// $db['default']['username'] = 'dev_master';
// $db['default']['password'] = 'dds1389GxG';
// $db['default']['database'] = 'dadabuswechat';
// $db['default']['dbdriver'] = 'mysqli';
// $db['default']['dbprefix'] = '';
// $db['default']['pconnect'] = FALSE;
// $db['default']['db_debug'] = TRUE;
// $db['default']['cache_on'] = FALSE;
// $db['default']['cachedir'] = '';
// $db['default']['char_set'] = 'utf8';
// $db['default']['dbcollat'] = 'utf8_general_ci';
// $db['default']['swap_pre'] = '';
// $db['default']['autoinit'] = TRUE;
// $db['default']['stricton'] = FALSE;


// 聊天室专用数据库
$active_group = 'chat';
$active_record = TRUE;
$db ['chat'] ['hostname'] = 'rdsr86cnr0mpteq29689.mysql.rds.aliyuncs.com:3306';
$db ['chat'] ['username'] = 'dev_master';
$db ['chat'] ['password'] = 'dds1389GxG';
$db ['chat'] ['database'] = 'db_chat';
$db ['chat'] ['dbdriver'] = 'mysqli';
$db ['chat'] ['dbprefix'] = '';
$db ['chat'] ['pconnect'] = FALSE;
$db ['chat'] ['db_debug'] = TRUE;
$db ['chat'] ['cache_on'] = FALSE;
$db ['chat'] ['cachedir'] = '';
$db ['chat'] ['char_set'] = 'utf8';
$db ['chat'] ['dbcollat'] = 'utf8_general_ci';
$db ['chat'] ['swap_pre'] = '';
$db ['chat'] ['autoinit'] = TRUE;
$db ['chat'] ['stricton'] = FALSE;

// 管理端专用数据库
$active_group = 'boss';
$active_record = TRUE;
$db ['boss'] ['hostname'] = 'rdsr86cnr0mpteq29689.mysql.rds.aliyuncs.com:3306';
$db ['boss'] ['username'] = 'dev_master';
$db ['boss'] ['password'] = 'dds1389GxG';
$db ['boss'] ['database'] = 'db_boss';
$db ['boss'] ['dbdriver'] = 'mysqli';
$db ['boss'] ['dbprefix'] = '';
$db ['boss'] ['pconnect'] = FALSE;
$db ['boss'] ['db_debug'] = TRUE;
$db ['boss'] ['cache_on'] = FALSE;
$db ['boss'] ['cachedir'] = '';
$db ['boss'] ['char_set'] = 'utf8';
$db ['boss'] ['dbcollat'] = 'utf8_general_ci';
$db ['boss'] ['swap_pre'] = '';
$db ['boss'] ['autoinit'] = TRUE;
$db ['boss'] ['stricton'] = FALSE;

//线路 - 专用主实例读写账号配置
$active_group = 'line';
$active_record = TRUE;
$db['line']['hostname'] = 'rdsr86cnr0mpteq29689.mysql.rds.aliyuncs.com:3306';
$db['line']['username'] = 'dev_master';
$db['line']['password'] = 'dds1389GxG';
$db['line']['database'] = 'db_line';
$db['line']['dbdriver'] = 'mysqli';
$db['line']['dbprefix'] = '';
$db['line']['pconnect'] = FALSE;
$db['line']['db_debug'] = TRUE;
$db['line']['cache_on'] = FALSE;
$db['line']['cachedir'] = '';
$db['line']['char_set'] = 'utf8';
$db['line']['dbcollat'] = 'utf8_general_ci';
$db['line']['swap_pre'] = '';
$db['line']['autoinit'] = TRUE;
$db['line']['stricton'] = FALSE;

//线路 - 专用只读实例只读账号配置
$active_group = 'db_line_r';
$active_record = TRUE;
$db['db_line_r']['hostname'] = 'rdsr86cnr0mpteq29689.mysql.rds.aliyuncs.com:3306';
$db['db_line_r']['username'] = 'dev_master';
$db['db_line_r']['password'] = 'dds1389GxG';
$db['db_line_r']['database'] = 'db_line';
$db['db_line_r']['dbdriver'] = 'mysqli';
$db['db_line_r']['dbprefix'] = '';
$db['db_line_r']['pconnect'] = FALSE;
$db['db_line_r']['db_debug'] = TRUE;
$db['db_line_r']['cache_on'] = FALSE;
$db['db_line_r']['cachedir'] = '';
$db['db_line_r']['char_set'] = 'utf8';
$db['db_line_r']['dbcollat'] = 'utf8_general_ci';
$db['db_line_r']['swap_pre'] = '';
$db['db_line_r']['autoinit'] = TRUE;
$db['db_line_r']['stricton'] = FALSE;

//包车报价系统
$active_group = 'charter_quote';
$active_record = TRUE;
$db['charter_quote']['hostname'] = 'rdsr86cnr0mpteq29689.mysql.rds.aliyuncs.com:3306';
$db['charter_quote']['username'] = 'dev_master';
$db['charter_quote']['password'] = 'dds1389GxG';
$db['charter_quote']['database'] = 'db_chartered_quote';
$db['charter_quote']['dbdriver'] = 'mysqli';
$db['charter_quote']['dbprefix'] = '';
$db['charter_quote']['pconnect'] = FALSE;
$db['charter_quote']['db_debug'] = TRUE;
$db['charter_quote']['cache_on'] = FALSE;
$db['charter_quote']['cachedir'] = '';
$db['charter_quote']['char_set'] = 'utf8';
$db['charter_quote']['dbcollat'] = 'utf8_general_ci';
$db['charter_quote']['swap_pre'] = '';
$db['charter_quote']['autoinit'] = TRUE;
$db['charter_quote']['stricton'] = FALSE;
//订单 只读
$active_group = 'order_read';
$active_record = TRUE;
$db['order_read']['hostname'] = 'rdsr86cnr0mpteq29689.mysql.rds.aliyuncs.com:3306';
$db['order_read']['username'] = 'dev_master';
$db['order_read']['password'] = 'dds1389GxG';
$db['order_read']['database'] = '';
$db['order_read']['dbdriver'] = 'mysqli';
$db['order_read']['dbprefix'] = '';
$db['order_read']['pconnect'] = FALSE;
$db['order_read']['db_debug'] = TRUE;
$db['order_read']['cache_on'] = FALSE;
$db['order_read']['cachedir'] = '';
$db['order_read']['char_set'] = 'utf8';
$db['order_read']['dbcollat'] = 'utf8_general_ci';
$db['order_read']['swap_pre'] = '';
$db['order_read']['autoinit'] = TRUE;
$db['order_read']['stricton'] = FALSE;
//任务 只读
$active_group = 'task_read';
$active_record = TRUE;
$db['task_read']['hostname'] = 'rdsr86cnr0mpteq29689.mysql.rds.aliyuncs.com:3306';
$db['task_read']['username'] = 'dev_master';
$db['task_read']['password'] = 'dds1389GxG';
$db['task_read']['database'] = 'db_task';
$db['task_read']['dbdriver'] = 'mysqli';
$db['task_read']['dbprefix'] = '';
$db['task_read']['pconnect'] = FALSE;
$db['task_read']['db_debug'] = TRUE;
$db['task_read']['cache_on'] = FALSE;
$db['task_read']['cachedir'] = '';
$db['task_read']['char_set'] = 'utf8';
$db['task_read']['dbcollat'] = 'utf8_general_ci';
$db['task_read']['swap_pre'] = '';
$db['task_read']['autoinit'] = TRUE;
$db['task_read']['stricton'] = FALSE;

//任务 读写
$active_group = 'task_write';
$active_record = TRUE;
$db['task_write']['hostname'] = 'rdsr86cnr0mpteq29689.mysql.rds.aliyuncs.com:3306';
$db['task_write']['username'] = 'dev_master';
$db['task_write']['password'] = 'dds1389GxG';
$db['task_write']['database'] = 'db_task';
$db['task_write']['dbdriver'] = 'mysqli';
$db['task_write']['dbprefix'] = '';
$db['task_write']['pconnect'] = FALSE;
$db['task_write']['db_debug'] = TRUE;
$db['task_write']['cache_on'] = FALSE;
$db['task_write']['cachedir'] = '';
$db['task_write']['char_set'] = 'utf8';
$db['task_write']['dbcollat'] = 'utf8_general_ci';
$db['task_write']['swap_pre'] = '';
$db['task_write']['autoinit'] = TRUE;
$db['task_write']['stricton'] = FALSE;
//司机只读
$active_group = 'driver';
$active_record = TRUE;
$db['driver']['hostname'] = 'rdsr86cnr0mpteq29689.mysql.rds.aliyuncs.com:3306';
$db['driver']['username'] = 'dev_master';
$db['driver']['password'] = 'dds1389GxG';
$db['driver']['database'] = 'db_driver';
$db['driver']['dbdriver'] = 'mysqli';
$db['driver']['dbprefix'] = '';
$db['driver']['pconnect'] = FALSE;
$db['driver']['db_debug'] = TRUE;
$db['driver']['cache_on'] = FALSE;
$db['driver']['cachedir'] = '';
$db['driver']['char_set'] = 'utf8';
$db['driver']['dbcollat'] = 'utf8_general_ci';
$db['driver']['swap_pre'] = '';
$db['driver']['autoinit'] = TRUE;
$db['driver']['stricton'] = FALSE;
//司机读写
$active_group = 'driver_w';
$active_record = TRUE;
$db['driver_w']['hostname'] = 'rdsr86cnr0mpteq29689.mysql.rds.aliyuncs.com:3306';
$db['driver_w']['username'] = 'dev_master';
$db['driver_w']['password'] = 'dds1389GxG';
$db['driver_w']['database'] = 'db_driver';
$db['driver_w']['dbdriver'] = 'mysqli';
$db['driver_w']['dbprefix'] = '';
$db['driver_w']['pconnect'] = FALSE;
$db['driver_w']['db_debug'] = TRUE;
$db['driver_w']['cache_on'] = FALSE;
$db['driver_w']['cachedir'] = '';
$db['driver_w']['char_set'] = 'utf8';
$db['driver_w']['dbcollat'] = 'utf8_general_ci';
$db['driver_w']['swap_pre'] = '';
$db['driver_w']['autoinit'] = TRUE;
$db['driver_w']['stricton'] = FALSE;

//driver_gps信息 只读
$active_group = 'driver_gps'; //ddb_report_r
$active_record = TRUE;
$db['driver_gps']['hostname'] = 'rdsr86cnr0mpteq29689.mysql.rds.aliyuncs.com:3306';
$db['driver_gps']['username'] = 'dev_master';
$db['driver_gps']['password'] = 'dds1389GxG';
$db['driver_gps']['database'] = '';
$db['driver_gps']['dbdriver'] = 'mysqli';
$db['driver_gps']['dbprefix'] = '';
$db['driver_gps']['pconnect'] = FALSE;
$db['driver_gps']['db_debug'] = TRUE;
$db['driver_gps']['cache_on'] = FALSE;
$db['driver_gps']['cachedir'] = '';
$db['driver_gps']['char_set'] = 'utf8';
$db['driver_gps']['dbcollat'] = 'utf8_general_ci';
$db['driver_gps']['swap_pre'] = '';
$db['driver_gps']['autoinit'] = TRUE;
$db['driver_gps']['stricton'] = FALSE;

//权限
$active_group = 'db_auth';
$active_record = TRUE;
$db['db_auth']['hostname'] = 'rdsr86cnr0mpteq29689.mysql.rds.aliyuncs.com:3306';
$db['db_auth']['username'] = 'dev_master';
$db['db_auth']['password'] = 'dds1389GxG';
$db['db_auth']['database'] = 'db_auth';
$db['db_auth']['dbdriver'] = 'mysqli';
$db['db_auth']['dbprefix'] = '';
$db['db_auth']['pconnect'] = FALSE;
$db['db_auth']['db_debug'] = TRUE;
$db['db_auth']['cache_on'] = FALSE;
$db['db_auth']['cachedir'] = '';
$db['db_auth']['char_set'] = 'utf8';
$db['db_auth']['dbcollat'] = 'utf8_general_ci';
$db['db_auth']['swap_pre'] = '';
$db['db_auth']['autoinit'] = TRUE;
$db['db_auth']['stricton'] = FALSE;

//包车
$active_group = 'chartered_order';
$active_record = TRUE;
$db['chartered_order']['hostname'] = 'rdsr86cnr0mpteq29689.mysql.rds.aliyuncs.com:3306';
$db['chartered_order']['username'] = 'dev_master';
$db['chartered_order']['password'] = 'dds1389GxG';
$db['chartered_order']['database'] = 'db_chartered';
$db['chartered_order']['dbdriver'] = 'mysqli';
$db['chartered_order']['dbprefix'] = '';
$db['chartered_order']['pconnect'] = FALSE;
$db['chartered_order']['db_debug'] = TRUE;
$db['chartered_order']['cache_on'] = FALSE;
$db['chartered_order']['cachedir'] = '';
$db['chartered_order']['char_set'] = 'utf8';
$db['chartered_order']['dbcollat'] = 'utf8_general_ci';
$db['chartered_order']['swap_pre'] = '';
$db['chartered_order']['autoinit'] = TRUE;
$db['chartered_order']['stricton'] = FALSE;

//包车 写实例
$active_group = 'chartered_order_w';
$active_record = TRUE;
$db['chartered_order_w']['hostname'] = 'rdsr86cnr0mpteq29689.mysql.rds.aliyuncs.com:3306';
$db['chartered_order_w']['username'] = 'dev_master';
$db['chartered_order_w']['password'] = 'dds1389GxG';
$db['chartered_order_w']['database'] = 'db_chartered';
$db['chartered_order_w']['dbdriver'] = 'mysqli';
$db['chartered_order_w']['dbprefix'] = '';
$db['chartered_order_w']['pconnect'] = FALSE;
$db['chartered_order_w']['db_debug'] = TRUE;
$db['chartered_order_w']['cache_on'] = FALSE;
$db['chartered_order_w']['cachedir'] = '';
$db['chartered_order_w']['char_set'] = 'utf8';
$db['chartered_order_w']['dbcollat'] = 'utf8_general_ci';
$db['chartered_order_w']['swap_pre'] = '';
$db['chartered_order_w']['autoinit'] = TRUE;
$db['chartered_order_w']['stricton'] = FALSE;

/*车企平台数据库*/
$active_group = 'db_car_platform';
$active_record = TRUE;
$db['db_car_platform']['hostname'] = 'rdsr86cnr0mpteq29689.mysql.rds.aliyuncs.com:3306';
$db['db_car_platform']['username'] = 'dev_master';
$db['db_car_platform']['password'] = 'dds1389GxG';
$db['db_car_platform']['database'] = 'db_car_platform';
$db['db_car_platform']['dbdriver'] = 'mysqli';
$db['db_car_platform']['dbprefix'] = '';
$db['db_car_platform']['pconnect'] = FALSE;
$db['db_car_platform']['db_debug'] = TRUE;
$db['db_car_platform']['cache_on'] = FALSE;
$db['db_car_platform']['cachedir'] = '';
$db['db_car_platform']['char_set'] = 'utf8';
$db['db_car_platform']['dbcollat'] = 'utf8_general_ci';
$db['db_car_platform']['swap_pre'] = '';
$db['db_car_platform']['autoinit'] = TRUE;
$db['db_car_platform']['stricton'] = FALSE;

/*车企平台数据库 只读*/
$active_group = 'ready_only__db_car_platform';
$active_record = TRUE;
$db['ready_only__db_car_platform']['hostname'] = 'rdsr86cnr0mpteq29689.mysql.rds.aliyuncs.com:3306';
$db['ready_only__db_car_platform']['username'] = 'dev_master';
$db['ready_only__db_car_platform']['password'] = 'dds1389GxG';
$db['ready_only__db_car_platform']['database'] = 'db_car_platform';
$db['ready_only__db_car_platform']['dbdriver'] = 'mysqli';
$db['ready_only__db_car_platform']['dbprefix'] = '';
$db['ready_only__db_car_platform']['pconnect'] = FALSE;
$db['ready_only__db_car_platform']['db_debug'] = TRUE;
$db['ready_only__db_car_platform']['cache_on'] = FALSE;
$db['ready_only__db_car_platform']['cachedir'] = '';
$db['ready_only__db_car_platform']['char_set'] = 'utf8';
$db['ready_only__db_car_platform']['dbcollat'] = 'utf8_general_ci';
$db['ready_only__db_car_platform']['swap_pre'] = '';
$db['ready_only__db_car_platform']['autoinit'] = TRUE;
$db['ready_only__db_car_platform']['stricton'] = FALSE;
//地推统计数据
$active_group = 'promote_r';
$db['promote_r']['hostname'] = '10.24.250.128:3308';
$db['promote_r']['username'] = 'ubi_script_w';
$db['promote_r']['password'] = 'Ddb2016xhtdxy';
$db['promote_r']['database'] = '';//ddb_oss_report
$db['promote_r']['dbdriver'] = 'mysqli';
$db['promote_r']['dbprefix'] = '';
$db['promote_r']['pconnect'] = FALSE;
$db['promote_r']['db_debug'] = TRUE;
$db['promote_r']['cache_on'] = FALSE;
$db['promote_r']['cachedir'] = '';
$db['promote_r']['char_set'] = 'utf8';
$db['promote_r']['dbcollat'] = 'utf8_general_ci';
$db['promote_r']['swap_pre'] = '';
$db['promote_r']['autoinit'] = TRUE;
$db['promote_r']['stricton'] = FALSE;

//线路优化评估
$active_group = 'line_evaluate';
$active_record = TRUE;
$db['line_evaluate']['hostname'] = '10.24.250.128:3308';
$db['line_evaluate']['username'] = 'ubi_script_w';
$db['line_evaluate']['password'] = 'Ddb2016xhtdxy';
$db['line_evaluate']['database'] = 'db_task';
$db['line_evaluate']['dbdriver'] = 'mysqli';
$db['line_evaluate']['dbprefix'] = '';
$db['line_evaluate']['pconnect'] = FALSE;
$db['line_evaluate']['db_debug'] = TRUE;
$db['line_evaluate']['cache_on'] = FALSE;
$db['line_evaluate']['cachedir'] = '';
$db['line_evaluate']['char_set'] = 'utf8';
$db['line_evaluate']['dbcollat'] = 'utf8_general_ci';
$db['line_evaluate']['swap_pre'] = '';
$db['line_evaluate']['autoinit'] = TRUE;
$db['line_evaluate']['stricton'] = FALSE;

//客服 - 专用只读实例只读账号配置
$active_group = 'customer_service_r';
$active_record = TRUE;
$db['customer_service_r']['hostname'] = 'rdsr86cnr0mpteq29689.mysql.rds.aliyuncs.com:3306';
$db['customer_service_r']['username'] = 'dev_master';
$db['customer_service_r']['password'] = 'dds1389GxG';
$db['customer_service_r']['database'] = 'db_customer_service';
$db['customer_service_r']['dbdriver'] = 'mysqli';
$db['customer_service_r']['dbprefix'] = '';
$db['customer_service_r']['pconnect'] = FALSE;
$db['customer_service_r']['db_debug'] = TRUE;
$db['customer_service_r']['cache_on'] = FALSE;
$db['customer_service_r']['cachedir'] = '';
$db['customer_service_r']['char_set'] = 'utf8';
$db['customer_service_r']['dbcollat'] = 'utf8_general_ci';
$db['customer_service_r']['swap_pre'] = '';
$db['customer_service_r']['autoinit'] = TRUE;
$db['customer_service_r']['stricton'] = FALSE;

//客服 - 专用主实例读写账号配置
$active_group = 'customer_service_w';
$active_record = TRUE;
$db['customer_service_w']['hostname'] = 'rdsr86cnr0mpteq29689.mysql.rds.aliyuncs.com:3306';
$db['customer_service_w']['username'] = 'dev_master';
$db['customer_service_w']['password'] = 'dds1389GxG';
$db['customer_service_w']['database'] = 'db_customer_service';
$db['customer_service_w']['dbdriver'] = 'mysqli';
$db['customer_service_w']['dbprefix'] = '';
$db['customer_service_w']['pconnect'] = FALSE;
$db['customer_service_w']['db_debug'] = TRUE;
$db['customer_service_w']['cache_on'] = FALSE;
$db['customer_service_w']['cachedir'] = '';
$db['customer_service_w']['char_set'] = 'utf8';
$db['customer_service_w']['dbcollat'] = 'utf8_general_ci';
$db['customer_service_w']['swap_pre'] = '';
$db['customer_service_w']['autoinit'] = TRUE;
$db['customer_service_w']['stricton'] = FALSE;

//车企结算
$active_group = 'db_che_settle';
$active_record = TRUE;
$db['db_che_settle']['hostname'] = 'rdsr86cnr0mpteq29689.mysql.rds.aliyuncs.com';
$db['db_che_settle']['username'] = 'dev_master';
$db['db_che_settle']['password'] = 'dds1389GxG';
$db['db_che_settle']['database'] = 'db_che_settle';
$db['db_che_settle']['dbdriver'] = 'mysqli';
$db['db_che_settle']['dbprefix'] = '';
$db['db_che_settle']['pconnect'] = FALSE;
$db['db_che_settle']['db_debug'] = TRUE;
$db['db_che_settle']['cache_on'] = FALSE;
$db['db_che_settle']['cachedir'] = '';
$db['db_che_settle']['char_set'] = 'utf8';
$db['db_che_settle']['dbcollat'] = 'utf8_general_ci';
$db['db_che_settle']['swap_pre'] = '';
$db['db_che_settle']['autoinit'] = TRUE;
$db['db_che_settle']['stricton'] = FALSE;

//数据库日志
$active_group = 'log';
$active_record = TRUE;
$db[$active_group]['hostname'] =  'rdsr86cnr0mpteq29689.mysql.rds.aliyuncs.com:3306';
$db[$active_group]['username'] = 'dev_master';
$db[$active_group]['password'] = 'dds1389GxG';
$db[$active_group]['database'] = 'db_log';
$db[$active_group]['dbdriver'] = 'mysql';
$db[$active_group]['dbprefix'] = '';
$db[$active_group]['pconnect'] = FALSE;
$db[$active_group]['db_debug'] = TRUE;
$db[$active_group]['cache_on'] = FALSE;
$db[$active_group]['cachedir'] = '';
$db[$active_group]['char_set'] = 'utf8';
$db[$active_group]['dbcollat'] = 'utf8_general_ci';
$db[$active_group]['swap_pre'] = '';
$db[$active_group]['autoinit'] = TRUE;
$db[$active_group]['stricton'] = FALSE;

//企业支付 - 专用只读实例只读账号配置
$active_group = 'company_pay_r';
$active_record = TRUE;
$db['company_pay_r']['hostname'] = 'rdsr86cnr0mpteq29689.mysql.rds.aliyuncs.com:3306';
$db['company_pay_r']['username'] = 'dev_master';
$db['company_pay_r']['password'] = 'dds1389GxG';
$db['company_pay_r']['database'] = 'db_company_pay';
$db['company_pay_r']['dbdriver'] = 'mysqli';
$db['company_pay_r']['dbprefix'] = '';
$db['company_pay_r']['pconnect'] = FALSE;
$db['company_pay_r']['db_debug'] = TRUE;
$db['company_pay_r']['cache_on'] = FALSE;
$db['company_pay_r']['cachedir'] = '';
$db['company_pay_r']['char_set'] = 'utf8';
$db['company_pay_r']['dbcollat'] = 'utf8_general_ci';
$db['company_pay_r']['swap_pre'] = '';
$db['company_pay_r']['autoinit'] = TRUE;
$db['company_pay_r']['stricton'] = FALSE;

// 数据导出任务 db_data_export_task
$active_group = 'db_data_export_task';
$active_record = TRUE;
$db['db_data_export_task']['hostname'] = 'rdsr86cnr0mpteq29689.mysql.rds.aliyuncs.com';
$db['db_data_export_task']['username'] = 'dev_master';
$db['db_data_export_task']['password'] = 'dds1389GxG';
$db['db_data_export_task']['database'] = 'db_data_export_task';
$db['db_data_export_task']['dbdriver'] = 'mysqli';
$db['db_data_export_task']['dbprefix'] = '';
$db['db_data_export_task']['pconnect'] = FALSE;
$db['db_data_export_task']['db_debug'] = FALSE;
$db['db_data_export_task']['cache_on'] = FALSE;
$db['db_data_export_task']['cachedir'] = '';
$db['db_data_export_task']['char_set'] = 'utf8';
$db['db_data_export_task']['dbcollat'] = 'utf8_general_ci';
$db['db_data_export_task']['swap_pre'] = '';
$db['db_data_export_task']['autoinit'] = TRUE;
$db['db_data_export_task']['stricton'] = FALSE;