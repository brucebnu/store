<?php

namespace brucebnu\store\tiktokshop\Nodes;

class Seller extends \brucebnu\store\tiktokshop\Node
{

    public function getNodeEndpoint(): string
    {
        return '/seller';
    }

}