<?php
/**
 * Created by PhpStorm.
 * User: stbz
 * Date: 2020/6/17
 * Time: 2:04 PM
 */

require_once __DIR__ . '/../vendor/autoload.php';

use Xmo\Api\SupplyClient;


$appKey = "11111";
$appSecret = "22222";

// 参数
$param = ['orderSn'=>rand(2,999999), 'spu'=>[['sku'=>'xxx','number'=>1]], 'address'=>[]];;

$supplyClient = new SupplyClient($param);
$supplyClient->setAppKey($appKey);
$supplyClient->setAppSecret($appSecret);

//获取商品列表
//$response = $supplyClient->product->setApi('/v2/Goods/Lists')->get();

//商品下单
//$response = $supplyClient->order->setApi('/v2/order')->post();

//获取商品详情
//$response = $supplyClient->product->setApi("/v2/Goods/Detail")->get();

//批量获取详情
//$response = $supplyClient->product->setApi("/v2/Goods/GetBulkGoodDetail")->get();

//获取全量分类
//$response = $supplyClient->product->setApi("/v2/Category/Lists")->get();

//获取逐级类目
//$response = $supplyClient->product->setApi("/v2/Category/GetCategory")->get();

//批量更新商品
//$response = $supplyClient->product->setApi("/v2/Goods/GetBulkGoodsMessage")->get();

//在线选品
//$response = $supplyClient->product->setApi("/v2/GoodsStorage/Lists")->get();

//选品库增加商品
//$response = $supplyClient->product->setApi("/v2/GoodsStorage/Add")->get();

//选品库商品列表
//$response = $supplyClient->product->setApi("/v2/GoodsStorage/MyLists")->get();

//选品库移除商品
//$response = $supplyClient->product->setApi("/v2/GoodsStorage/Remove")->get();
