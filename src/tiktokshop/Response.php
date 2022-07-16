<?php


namespace brucebnu\store\tiktokshop;


use GuzzleHttp\Psr7\Response as GuzzleResponse;

class Response
{
//json_decode($response->getBody()->getContents())

    private GuzzleResponse $response;
    private array $params;

    public function __construct(GuzzleResponse $response, array $params)
    {
        $this->response = $response;
        $this->params = $params;
    }

    public function body()
    {
        return $this->response->getBody();
    }

    public function contents()
    {
        return $this->body()->getContents();
    }

    public function object($is_array=false)
    {
        return json_decode($this->contents(), $is_array);
    }

    public function json()
    {
        return json_decode($this->contents(), true);
    }

    public function getData($object = false)
    {
        if ($object)
            return $this->object()->data;

        return $this->json()['data'];
    }

    public function getPaginator()
    {
        if (!isset($this->params['page_size']) || !isset($this->params['page_number']))
            return null;

        return [
            'page' => $this->params['page_number'],
            'pageSize' => $this->params['page_size'],
            'total' => $this->object()->data->total,
        ];
    }

}
