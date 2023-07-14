<?php

namespace Xmo\Api\Provider;


use Xmo\Api\Core\Container;
use Xmo\Api\Functions\Order\Logistics;
use  Xmo\Api\Functions\Product\Product;
use  Xmo\Api\Interfaces\Provider;

class ProductProvider implements Provider
{
    /**
     * @inheritDoc
     */
    public function serviceProvider(Container $container)
    {
        $container['product'] = function ($container) {
            return new Product($container);
        };
        $container['logistics'] = function ($container) {
            return new Logistics($container);
        };
    }
}