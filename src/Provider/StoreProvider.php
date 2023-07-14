<?php

namespace Xmo\Api\Provider;

use Xmo\Api\Core\Container;
use Xmo\Api\Functions\Order\Order;
use Xmo\Api\Functions\Order\Refund;
use Xmo\Api\Interfaces\Provider;

/**
 * Class StoreProvider
 * @package Xmo\Api\Provider
 */
class StoreProvider implements Provider
{

    /**
     * 服务提供者
     * @param Container $container
     */
    public function serviceProvider(Container $container)
    {
        $container['order']  = function ($container) {
            return new Order($container);
        };
        $container['refund'] = function ($container) {
            return new Refund($container);
        };
    }
}
