<?php


namespace brucebnu\store\tiktokshop;


/**
 * Class Client
 * @package brucebnu\store\TiktokShopApi
 *
 * @method \brucebnu\store\tiktokshop\Nodes\Shop shop()
 * @method \brucebnu\store\tiktokshop\Nodes\Product product()
 * @method \brucebnu\store\tiktokshop\Nodes\Order order()
 * @method \brucebnu\store\tiktokshop\Nodes\Logistics logistics()
 * @method \brucebnu\store\tiktokshop\Nodes\Finance finance()
 * @method \brucebnu\store\tiktokshop\Nodes\ReverseOrder reverseOrder()
 * @method \brucebnu\store\tiktokshop\Nodes\Fulfillment fulfillment()
 */
class Client
{
    use HasAuthorization;

    public string $apiHost = "https://open-api.tiktokglobalshop.com";

    public string $appKey;

    public string $appSecret;

    public string $shopId;

    public string $accessToken;

    public function __construct(array $config = [])
    {
        $this->appKey = $config['app_key'] ?? '';
        $this->appSecret = $config['app_secret'] ?? '';
        $this->shopId = $config['shop_id'] ?? '';
        $this->accessToken = $config['access_token'] ?? '';
    }

    public function __call($name, $arguments)
    {
        $className = 'Yeejiawei\\TiktokShopApi\\Nodes\\' . ucfirst($name);
        if (!class_exists($className)) {
            throw new \Exception("Class {$className} not found");
        }
        return new $className($this);
    }

}
