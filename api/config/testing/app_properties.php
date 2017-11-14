<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| Application Properties
|--------------------------------------------------------------------------
|
| These properties are used when working with config files.
|
*/

// memcache
define('APP_MEMCACHED_IP', 'cfd9554f0f7347ba.m.cnszalist4pub001.ocs.aliyuncs.com');
define('APP_MEMCACHED_PORT', '11211');
define('APP_MEMCACHED_SASL_USER', 'cfd9554f0f7347ba');
define('APP_MEMCACHED_SASL_PWD', 'Xg23g5ABdP');

define('BOSS_MEMCACHED_IP', 'cfd9554f0f7347ba.m.cnszalist4pub001.ocs.aliyuncs.com');
define('BOSS_MEMCACHED_PORT', '11211');
define('BOSS_MEMCACHED_SASL_USER', 'cfd9554f0f7347ba');
define('BOSS_MEMCACHED_SASL_PWD', 'Xg23g5ABdP');

define('GPS_MEMCACHED_IP', 'cfd9554f0f7347ba.m.cnszalist4pub001.ocs.aliyuncs.com');
define('GPS_MEMCACHED_PORT', '11211');
define('GPS_MEMCACHED_SASL_USER', 'cfd9554f0f7347ba');
define('GPS_MEMCACHED_SASL_PWD', 'Xg23g5ABdP');

// 包车报价系统服务器IP
define ( 'PB_CHARTER_QUOTE_SYSTEM_IP', '10.169.207.40' );
define ( 'PB_CHARTER_QUOTE_SYSTEM_IP_2', '10.169.207.40' );
// 包车报价系统服务器端口
define ( 'PB_CHARTER_QUOTE_SYSTEM_PORT', 30120);
define ( 'PB_CHARTER_QUOTE_SYSTEM_PORT_2', 30120);

// ONS服务器IP
define ( 'PB_ONS_IP', '10.169.207.40' );
define ( 'PB_ONS_IP_2', '10.169.207.40' );
// ONS服务端口
define ( 'PB_ONS_BATCH_PORT', 11100 );     // 批量端口1
define ( 'PB_ONS_BATCH_PORT_2', 11100 );   // 批量端口2
define ( 'PB_ONS_DEYLAY_BATCH_PORT', 11100 );     // 批量端口1  延迟（非及时发送）
define ( 'PB_ONS_DEYLAY_BATCH_PORT_2', 11100 );   // 批量端口2  延迟（非及时发送）

// 包车业务服务器IP
define ( 'PB_CHARTERED_BUS_IP', '10.169.207.40' );
define ( 'PB_CHARTERED_BUS_IP_2', '10.169.207.40' );
// 包车业务服务端口
define ( 'PB_CHARTERED_BUS_PORT', 20119 );
define ( 'PB_CHARTERED_BUS_PORT_2', 20119 );

// 退款服务器IP
define ( 'PB_REFUND_IP', '10.169.207.40' );
define ( 'PB_REFUND_IP_2', '10.169.207.40' );
// 退款服务器端口
define ( 'PB_REFUND_PORT', 10005 );
define ( 'PB_REFUND_PORT_2', 10005 );

//代金券服务器IP
define ( 'PB_COUPON_SERVER_IP', '10.169.207.40' );
define ( 'PB_COUPON_SERVER_IP_2', '10.169.207.40' );
//代金券服务器端口
define ( 'PB_COUPON_SERVER_PORT', 9999 );
define ( 'PB_COUPON_SERVER_PORT_2', 9999 );

//DB代理服器配置
define ('DB_PROXY_SERVER_IP_1', '10.169.207.40');
define ('DB_PROXY_SERVER_IP_2', '10.169.207.40');
define ('DB_PROXY_SERVER_PORT_1', 11700);
define ('DB_PROXY_SERVER_PORT_2', 11700);
//企业支付
define('COMPANY_PAY_SERVER_IP_1', '10.169.207.40');
define('COMPANY_PAY_SERVER_IP_2', '10.169.207.40');
define('COMPANY_PAY_SERVER_PORT_1', 8182);
define('COMPANY_PAY_SERVER_PORT_2', 8182);
//企业服务
define('COMPANY_SERVER_IP_1', '10.169.207.40');
define('COMPANY_SERVER_IP_2', '10.169.207.40');
define('COMPANY_SERVER_PORT_1', 40130);
define('COMPANY_SERVER_PORT_2', 40130);

//车企合同、车企结算服务器IP
define ( 'BUS_COMPANY_INFO_INSERT_IP', '10.169.207.40' );
define ( 'BUS_COMPANY_INFO_INSERT_IP_2', '10.169.207.40' );
//车企合同、车企结算服务器端口
define ( 'BUS_COMPANY_CONTRACT_INSERT_PORT', 10245 );
define ( 'BUS_COMPANY_SETTLE_PORT', 10225 );

//车企加盟 服务器端口
define ( 'ALLIANCE_BILL_SERVER_IP', '10.169.207.40' );
define ( 'ALLIANCE_BILL_SERVER_IP_2', '10.169.207.40' );
define ( 'ALLIANCE_BILL_SERVER_PORT', 10228 );

//快捷支付URL
define ( 'QUICK_PAY_URL', 'http://dev.wechat.dadabus.com/v2/wechat_menu/index?wxMenu=quick_pay');

define ( 'GRANT_TICKET_IP_1', '10.169.207.40' );
define ( 'GRANT_TICKET_IP_2', '10.169.207.40' );
define ( 'GRANT_TICKET_PORT_1', 10004 );
define ( 'GRANT_TICKET_PORT_2', 10004 );