<?php

namespace Xmo\Api\Tools;

trait Sign
{
    public array $paramMap = array();

    public string $body = '';


    /**
     * 获取时间戳到毫秒
     * @return bool|string
     */
    public function getMillisecond(): bool|string
    {
        list($msec, $sec) = explode(' ', microtime());
        $secondTime = (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
        $secondTime = self::NumToStr($secondTime);
        return substr($secondTime, 0, 13);
    }

    public function setOnnce(): string
    {
        return md5($this->paramMap['Api-App-Key'] . $this->paramMap['Api-Time-Stamp']);
    }

    /**
     * 科学计数法，还原成字符串
     */
    public function numToStr($num){
        if (stripos($num,'e')===false) return $num;
        $num = trim(preg_replace('/[=\'"]/','',$num,1),'"');//出现科学计数法，还原成字符串
        $result = "";
        while ($num > 0){
            $v = $num - floor($num / 10)*10;
            $num = floor($num / 10);
            $result   =   $v . $result;
        }
        return $result;
    }

    /**
     * 将参数转换成k=v拼接的形式
     */
    public function toQueryString(): string
    {
        $StrQuery="";
        foreach ($this->paramMap as $k=>$v){
            $StrQuery .= strlen($StrQuery) == 0 ? "" : "&";
            $StrQuery.=$k."=".urlencode($v);
        }
        return $StrQuery;
    }

    /**
     * 签名
     * @param array $data
     * @param string $appSecret
     * @param string $body
     * @return string
     */
    public static function getSign(array $data, string $appSecret , string $body = ''): string
    {
        ksort($data);
        $body = str_replace(" ","",$body);

        $str_key="";
        foreach ($data as $k=>$v){
            $str_key.=$k.$v;
        }
        $str_key .= $appSecret;
        $str_key .= $body;
        return strtoupper(md5(sha1($str_key)));
    }

}