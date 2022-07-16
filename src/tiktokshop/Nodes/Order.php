<?php


namespace brucebnu\store\tiktokshop\Nodes;


use brucebnu\store\tiktokshop\Node;

class Order extends Node
{
    public function getNodeEndpoint(): string
    {
        return '/orders';
    }

    /**
     * Get Order List
     *
     * Default page size is 25
     *
     * @param array $params
     * @return mixed
     */
    public function getOrderList(array $params = [])
    {
        if (!isset($params['page_size'])) {
            $params['page_size'] = 25;
        }

        return $this->post('/search', $params);
    }

    /**
     * Get Order Detail by list of order ids
     *
     * @param array<string> $orderIds
     * @return mixed
     */
    public function getOrderDetails(array $orderIds = []): mixed
    {
        return $this->post('/detail/query', ['order_id_list' => $orderIds]);
    }
}
