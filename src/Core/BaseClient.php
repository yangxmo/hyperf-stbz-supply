<?php

namespace Xmo\Api\Core;

use Hyperf\Codec\Json;
use Xmo\Api\Tools\Guzzle;
use Xmo\Api\Tools\Sign;

/**
 * Class BaseClient
 * @package Xmo\Api\Core
 * @property BaseClient app
 */
class BaseClient
{
    use Sign;

    protected Container $app;
    public string $baseUrl = 'https://api.jxhh.com/';
    public string $urlInfo;
    protected array $postData;

    /**
     * BaseClient constructor.
     * @param Container $app
     */
    public function __construct(Container $app)
    {
        $this->app = $app;
    }


    /**
     * 签名
     */
    public function sign(string $method): void
    {
        $this->paramMap['Api-App-Key'] = $this->app->appkey;
        $this->paramMap['Api-Time-Stamp'] = $this->getMillisecond();
        $this->paramMap['Api-Nonce'] = $this->setOnnce();
        $method == 'get' && $this->paramMap = array_merge($this->app->params, $this->paramMap);
    }

    /**
     * GET请求方式
     * @return array
     */
    public function get(): array
    {
        $this->sign('get');
        $this->paramMap['Api-Sign'] = self::getSign($this->paramMap, $this->app->appSecret);
        return $this->curlRequest($this->urlInfo, $this->paramMap, 'get');
    }

    /**
     * POST请求方式
     * @throws array|Exception
     */
    public function post()
    {
        $this->sign('post');
        $this->paramMap['Api-Sign'] = self::getSign($this->paramMap, $this->app->appSecret, Json::encode($this->app->params));

        return $this->curlRequest($this->urlInfo, $this->app->params, 'post');
    }

    /**
     * PATCH请求方式
     * @throws array|Exception
     */
    public function patch(): array
    {
        $this->sign('patch');
        $this->paramMap['Api-Sign'] = self::getSign($this->paramMap, $this->app->appSecret, Json::encode($this->app->params));
        return $this->curlRequest($this->urlInfo, $this->app->params, 'patch');
    }

    /**
     * 设置API地址
     * @param string $path
     * @return $this
     */
    public function setApi(string $path): static
    {
        $this->urlInfo = $path;
        return $this;
    }

    /**
     * curl 请求
     * @param string $url
     * @param array $data
     * @param string $method
     * @param int $timeout
     * @return array
     */
    public function curlRequest(string $url,array $data,string $method = 'get', int $timeout = 10): array
    {
        // 设置header
        $headers = [
            'Api-App-Key' => $this->paramMap['Api-App-Key'],
            'Api-Time-Stamp' => $this->paramMap['Api-Time-Stamp'],
            'Api-Nonce' => $this->paramMap['Api-Nonce'],
            'Api-Sign'=> $this->paramMap['Api-Sign'],
            'Content-Type' => 'application/json'
        ];

        /** @var Guzzle $client */
        $client = \Hyperf\Support\make(Guzzle::class);

        $client->setHttpHandle(
            [
                'base_uri' => $this->baseUrl,
                'timeout' => $timeout,
                'headers' => $headers
            ]
        );

        $method = 'send' . ucfirst($method);

        return $client->$method($url, $data);
    }

}
