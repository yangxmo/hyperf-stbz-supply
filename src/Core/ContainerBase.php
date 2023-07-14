<?php

namespace Xmo\Api\Core;

/**
 * Class ContainerBase
 * @package Xmo\Api\Core
 */
class ContainerBase extends Container
{
    protected array $provider = [];

    public array $params = array();

    public string $appkey = '';
    public string $appSecret = '';

    /**
     * ContainerBase constructor.
     * @param array $params
     */
    public function __construct(array $params = array())
    {
        if ($params) {
            foreach ($params as &$item) {
                if (is_array($item) || is_object($item)) {
                    $item = json_encode($item, JSON_UNESCAPED_UNICODE);
                }
            }
        }
        $this->params = $params;
        $providerCallback = function ($provider) {
            $obj = new $provider;
            $this->serviceRegister($obj);
        };
        array_walk($this->provider, $providerCallback);//注册
    }

    /**
     * @param $id
     * @return mixed
     */
    public function __get($id)
    {
        return $this->offsetGet($id);
    }

    /**
     * @param string $appSecret
     * @return ContainerBase
     */
    public function setAppSecret(string $appSecret): static
    {
        $this->appSecret = $appSecret;
        return $this;
    }

    /**
     * @param mixed $appkey
     * @return ContainerBase
     */
    public function setAppKey(string $appkey): static
    {
        $this->appkey = $appkey;
        return $this;
    }


}
