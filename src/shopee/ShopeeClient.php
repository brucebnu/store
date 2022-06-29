<?php

namespace brucebnu\store\shopee;

use Shopee\Client;

class ShopeeClient extends Client
{
    public function __construct(array $config = [])
    {
        parent::__construct($config);
    }
}