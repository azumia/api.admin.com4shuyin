<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 通用的配置项
 */
// 运营日志配置
$config['ddb_opt_log_file'] = $_SERVER['DOCUMENT_ROOT'] . '/../../opt_log/ddb_opt_log';

// 亿美短信相关配置
$config ['yimei_cdkey'] = '9SDK-EMY-0999-JETQT';
$config ['yimei_password'] = '222597';
$config ['yimei_gwUrl'] = 'http://sdk999ws.eucp.b2m.cn:8080/sdk/SDKService';
$config ['yimei_proxyhost']=false;
$config ['yimei_proxyport']=false;

//阿里云 oss
$config ['oss_bucket'] = 'data-storage';
$config ['oss_access_id'] = 'gZncZy8V9c9fyNJO';
$config ['oss_access_key'] = 'sNtfD48oFF26LY0mxe0l59gOG2mPdz';
$config ['oss_endpoint'] = 'oss-cn-shenzhen.aliyuncs.com';
$config ['oss_host_name'] = 'http://data-storage.oss-cn-shenzhen.aliyuncs.com/';

$config ['report_oss'] = array (
    'bucket' => 'report-stroage',
    'access_id' => 'yJZS4TjRfoSFdQNv',
    'access_key' => 'CEZh1uhcvSCTbu35fLJJxWy0712Bxs',
    'endpoint' => 'oss-cn-shenzhen.aliyuncs.com',
    'host_name' => 'http://report-stroage.oss-cn-shenzhen.aliyuncs.com/'
);

// rongcloud相关配置
$config ['rongcloud_config'] = array (
    'appkey' => 'uwd1c0sxd3621',
    'secret' => 'vYQ1V27xjJ'
);

//包车起步里程 （米）
$config ['start_kilometer'] = 5000;

//包车 固定价格 城市
$config ['fixed_price_city_code'] = array('0755', '010', '020');

//包车 基于里程价格 城市
$config ['distance_price_city_code'] = array('021','029');

// 车企平台 域
$config ['che_domain'] = "http://che.api.dadabus.com/";
//地推工具新用户注册
$config['new_register_url'] = "http://wechat.buskeji.com";
// 推广二维码 微信 域
$config ['quick_pay_domain'] = "http://wechat.buskeji.com/webapp/quick_pay.html?";
//管理后台接口访问域名
$config ['boss_domain'] = "http://boss.dadabus.com/";
//迟到赔付代金券
$config['compensate_coupon'] = array(
    'common_coupon' => array(
        'coupon_id_20' => 781,
        'coupon_id_15' => 780,
        'coupon_id_10' => 90,
        'coupon_id_5' => 91,
        'coupon_id_2' => 92,
        'coupon_id_1' => 93,
    ),
    'on_coupon' => array(
        'coupon_id_20' => 783,
        'coupon_id_15' => 785,
        'coupon_id_10' => 313,
        'coupon_id_5' => 312,
        'coupon_id_2' => 311,
        'coupon_id_1' => 310,
    ),
    'off_coupon' => array(
        'coupon_id_20' => 784,
        'coupon_id_15' => 786,
        'coupon_id_10' => 317,
        'coupon_id_5' => 316,
        'coupon_id_2' => 315,
        'coupon_id_1' => 314,
    ),
);
//自定义推送消息 网址
$config['push_domain'] = "http://wechat.dadabus.com";