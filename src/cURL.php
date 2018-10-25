<?php

namespace Kernel;

class cURL
{
   public $url = '';

    public function __construct($url)
    {
        $this->url = $url;
    }

    public static function curlInit($url,$post_data=false,$ignore_ssl=true)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_USERAGENT, 'Chrome 42.0.2311.135 Pentamob');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_URL, $url);
        if($ignore_ssl){
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //信任任何证书
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); // 检查证书中是否设置域名,0不验证
        }
        /*$proxy = config('proxy');
        if($proxy){
            curl_setopt($curl, CURLOPT_HTTPPROXYTUNNEL, true);
            curl_setopt($curl, CURLOPT_PROXYAUTH, CURLAUTH_BASIC);
            curl_setopt($curl, CURLOPT_PROXYTYPE, $proxy['type']);
            curl_setopt($curl, CURLOPT_PROXY, $proxy['host']);
            curl_setopt($curl, CURLOPT_PROXYPORT, $proxy['port']);
            isset($proxy['user']) && curl_setopt($curl, CURLOPT_PROXYUSERPWD, $proxy['user'].':'.$proxy['passwd']);
        }*/
        if($post_data){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
        }
        $data = curl_exec($curl);
        $data or dbug(curl_error($curl));
        curl_close($curl);
        return $data;
    }

}