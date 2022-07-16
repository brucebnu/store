<?php


namespace brucebnu\store\tiktokshop\Nodes;


class Shop extends \brucebnu\store\tiktokshop\Node
{

    public function getNodeEndpoint(): string
    {
        return '/shop';
    }

    public function getAuthorizedShop(array $params = [], $is_array=false)
    {
        return $this->get('/get_authorized_shop', $params, $is_array);
    }
}
