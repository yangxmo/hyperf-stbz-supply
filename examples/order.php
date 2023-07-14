<?php
/**
 * Created by PhpStorm.
 * User: stbz
 * Date: 2020/6/17
 * Time: 4:00 PM
 */

require_once __DIR__ . '/../vendor/autoload.php';

use Xmo\Api\SupplyClient;

$appKey = "B5EB05025DFBA47329BAD796A92B2812195551660619929";
$appSecret = "C90FDADB1599C376627EC7E03640B683";

$param =[
	'address'=>[
		'consignee' => '小胜',
		'phone' => '13000000000',
		'province' => '北京市',
		'city' => '北京市',
		'area' => '丰台区',
		'street' => '卢沟桥街道',
		'description' => '和谐银座商场',
	],

	'spu' => [
		[
			'sku'=>5542227,
			'number'=>1,
		],
	],
];

$supplyClient = new SupplyClient([]);
$supplyClient->setAppKey($appKey);
$supplyClient->setAppSecret($appSecret);


//可售检测
//$response = $supplyClient->order->serApi("/v2/order/availableCheck")->get();
//前置校验
//$response = $supplyClient->order->setApi("post","/v2/order/beforeCheck")->get();

//下单接口
//$param =[
//	'address'=>[
//		'consignee' => '小胜',
//		'phone' => '13000000000',
//		'province' => '北京市',
//		'city' => '北京市',
//		'area' => '丰台区',
//		'street' => '卢沟桥街道',
//		'description' => '和谐银座商场',
//	],
//
//	'spu' => [
//		[
//			'sku'=>15570,//skuId
//			'number'=>1,
//		],
//	],
//	'orderSn'=>'thirdsn20200617160900001',//商城订单号
//];

//$supplyClient = new SupplyClient($param);
//$supplyClient->setAppKey($appKey);
//$supplyClient->setAppSecret($appSecret);

//$response = $supplyClient->order->setApi("/v2/order")->get();

//失败补单
//$param = ['orderSn'=>'0200617160_2_1'];
//$response = $supplyClient->order->setApi("/v2/order")->get();

//全平台订单列表
//$param = ['page'=>1,'limit'=>20];
//$response = $supplyClient->order->setApi("/v2/order")->get();
//各平台订单列表
//$source =2;//京东渠道
//$response = $supplyClient->order->setApi("/v2/order/source".$source)->get();

//订单详情
//$param = [];
//$sn ="20191115204845294762_6_1_1";//三级订单号
//$response = $supplyClient->order->setApi("/v2/order/".$sn)->get();

//物流查询
//$param = [
//	'orderSn'=>'20200610111116', //商城订单号
//	'sku'=>4339236
//];
//
//$response = $supplyClient->order->setApi("/v2/logistic")->get();

//物流查询
//$param = [];
//$response = $supplyClient->order->setApi("/v2/logistic/firms")->get();

var_dump($response);