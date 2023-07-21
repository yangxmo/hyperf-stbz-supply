# 聚合供应链平台SDK
## 更新时间: 2023-07-13 15:00:21
## Installing

```shell
$ composer require yangxmo/hyperf-stbz-supply -vvv
```

## Usage

```php
        $obj = new \Xmo\Api\SupplyClient(['page'=>1]);
        $obj->setAppkey('你的appkey');
        $obj->setAppsecret('你的秘钥');
        $res =$obj->order->setApi('文档中的API地址')->get(); //api 就是聚合文档中的
        var_dump($res);
```

项目中可以继承他：

````php
<?php


namespace App\Services\ApiOpen;


class AliOpen extends \Xmo\Api\SupplyClient
{
    public function __construct($params = array())
    {
        $this->setAppkey('39376**');
        $this->setAppsecret('0RsvFZYV**');
        parent::__construct($params);
    }
}

````

获取商品列表的例子
```php
        $get_data =( new  \Xmo\Api\SupplyClient([
            'page'=>1,
            'limit'=>100,
        ]))
            ->order
            ->setApi('/v2/Goods/Lists')
            ->get();
```
获取订单详情的例子
```php
        $orderSn = '20191115204845294762_6_1_1';
    
        $get_data = (new \Xmo\Aapi\SupplyClient([]))
            ->order
            ->setApi("/v2/order/".$orderSn)
            ->get();

```

更新日志：

1.修复php8下，因为强类型返回参数报错问题
2.增加hyperf 协程 Guzzle client 客户端
3.修复部分bug
4.重新设计sdk架构
5.处理替换curl

## License

MIT
