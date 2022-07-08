<?php

namespace brucebnu\store\shopee;


use Haistar\ShopeePhpSdk\request\general\GeneralApiClient;
use Haistar\ShopeePhpSdk\request\shop\ShopApiClient;

use Haistar\ShopeePhpSdk\client\ShopeeApiConfig;
use Haistar\ShopeePhpSdk\client\SignGenerator;

/**
 * Shopee 请求客户端
 *
 * Shopee接口设计挺奇怪的，需要注意两点
 *
 * # 第一点 签名在不同分类的接口，签名所需字段和顺序要注意
 * Shop APIs: partner_id, api path, timestamp, access_token, shop_id
 * Merchant APIs: partner_id, api path, timestamp, access_token, merchant_id
 * Public APIs: partner_id, api path, timestamp
 *
 * # 第二点 签名所需字段参数、get参数、post参数，需要注意，最好在命名的时候分开，清晰隔离开。
 * sign_params 签名用，例如 partner_id 签名中用，然后get参数中也用
 * get_params 放在url里的get参数，post请求可能也有。
 * post_params 放在post body体的请求参数
 *
 */
class ShopeeClient
{
    public $api;
    public $sign_params; // 签名参数

    /**
     * @param $hostUrl
     * @param string $type
     * @param array $config
     */
    public function __construct($hostUrl, string $type = 'general', array $config = [])
    {
        if($type == 'general'){

        }
    }

    public function execute(ShopeeRequest $request, $accessToken = null)
    {

    }

}