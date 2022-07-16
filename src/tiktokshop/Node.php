<?php


namespace brucebnu\store\tiktokshop;

abstract class Node
{
    use HttpNode;

    public Client $client;

    abstract public function getNodeEndpoint(): string;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}
