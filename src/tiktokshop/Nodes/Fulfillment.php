<?php


namespace brucebnu\store\tiktokshop\Nodes;


use brucebnu\store\tiktokshop\Node;

class Fulfillment extends Node
{
    public function getNodeEndpoint(): string
    {
        return '/fulfillment';
    }

    /**
     * Search pre-combine packages
     *
     * Default page size is 25
     *
     * @param array $params
     * @return mixed
     */
    public function searchPreCombinePkg(array $params = []): mixed
    {
        if (!isset($params['page_size'])) {
            $params['page_size'] = 25;
        }

        return $this->get('/pre_combine_pkg/list', $params);
    }

    /**
     * Confirm pre-combine packages
     *
     * @param array $params
     * @return mixed
     */
    public function confirmPreCombinePkg(array $params = []): mixed
    {
        return $this->post('/pre_combine_pkg/confirm', $params);
    }

    /**
     * Cancel pre-combine packages
     *
     * @param string $packageId
     * @param array<string> $orderIds
     * @return mixed
     */
    public function removePackageOrder(string $packageId, array $orderIds): mixed
    {
        return $this->post('/package/remove', ['package_id' => $packageId, 'order_id_list' => $orderIds]);
    }

    public function getPackagePickupConfig(string $packageId)
    {
        return $this->get('/package_pickup_config/list', ['package_id' => $packageId]);
    }

    public function searchPackage(array $params = [])
    {
        if (!isset($params['page_size'])) {
            $params['page_size'] = 25;
        }

        return $this->post('/search', $params);
    }

    public function getPackageDetail(string $packageId)
    {
        return $this->get('/detail', ['package_id' => $packageId]);
    }

    /**
     * @param string $packageId
     * @param string $documentType , 1 for 'SHIPPING_LABEL', 2 for 'PICK_LIST'
     * @param string $documentSize
     * @return mixed
     */
    public function getPackageShippingDocument(string $packageId, int $documentType, string $documentSize = '')
    {
        return $this->get('/shipping_document', [
            'package_id' => $packageId,
            'document_type' => $documentType,
            'document_size' => $documentSize,
        ]);
    }

    public function getPackageShippingInfo(string $packageId)
    {
        return $this->get('/shipping_info', ['package_id' => $packageId]);
    }

    public function updatePackageShippingInfo(string $packageId, string $trackingNumber, string $providerId)
    {
        return $this->get('/shipping_info/update', [
            'package_id' => $packageId,
            'tracking_number' => $trackingNumber,
            'provider_id' => $providerId,
        ]);
    }

    /**
     * For detail please see https://bytedance.feishu.cn/docx/doxcnmJKfEIJ31Pi5xLeWhW66Id#doxcnO0scU4qQ6QU6uA0CJYUALh
     *
     * @param array $params
     * @return mixed
     */
    public function shipPackage(array $params = [])
    {
//        dd(json_encode($params));
        return $this->post('/rts', $params);
    }

}
