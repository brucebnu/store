<?php


namespace brucebnu\store\tiktokshop\Nodes;


class Shop extends \Yeejiawei\TiktokShopApi\Node
{

    public function getNodeEndpoint(): string
    {
        return '/shop';
    }

    public function getAuthorizedShop(array $params = [])
    {
        return $this->get('/get_authorized_shop', $params);
    }
}
