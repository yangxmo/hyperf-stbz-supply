<?php
namespace Xmo\Api;

use Xmo\Api\Core\ContainerBase;
use Xmo\Api\Provider\ProductProvider;
use Xmo\Api\Provider\StoreProvider;

/**
 * Class Application
 */
class SupplyClient extends ContainerBase
{
    /**
     * AlibabaClient constructor.
     * @param array $params 应用级参数
     */
    public function __construct(array $params = array())
    {
        parent::__construct($params);
    }

    /**
     * 服务提供者
     * @var array
     */
    protected array $provider = [
        StoreProvider::class,
        ProductProvider::class,
        //...其他服务提供者
    ];
}
