<?php


namespace brucebnu\store\tiktokshop\Nodes;


use brucebnu\store\tiktokshop\Node;

class Product extends Node
{
    public function getNodeEndpoint(): string
    {
        return '/products';
    }

    public function getCategory()
    {
        return $this->get('/categories', []);
    }

    /**
     * @param string $categoryId
     * @return mixed
     */
    public function getCategoryAttribute(string $categoryId)
    {
        return $this->get('/attributes', ['category_id' => $categoryId]);
    }

    /**
     * To get category which 'is_leaf' is true
     *
     * @param string $categoryId
     * @return mixed
     */
    public function getCategoryRule(string $categoryId)
    {
        return $this->get('/categories/rules', ['category_id' => $categoryId]);
    }

    public function getBrand(array $params = [])
    {
        return $this->get('/brands', $params);
    }

    public function uploadImage(array $params = [])
    {
        return $this->post('/upload_imgs', $params);
    }

    public function uploadFile(array $params = [])
    {
        return $this->post('/upload_files', $params);
    }

    public function createProduct(array $params = [])
    {
        return $this->post('/', $params);
    }

    public function editProduct(array $params = [])
    {
        return $this->put('/', $params);
    }

    public function getProductList(array $params = [])
    {
        return $this->post('/search', $params);
    }

    public function getProductDetail(string $productId, array $params = [])
    {
        return $this->get('/details', array_merge($params, [
            'product_id' => $productId,
        ]));
    }

    /**
     * @param string $productId
     * @param array{id: string, original_price: string> $skus
     *
     * @return mixed|\Yeejiawei\TiktokShopApi\Response
     */
    public function updatePrice(string $productId, array $skus = [])
    {
        return $this->put('/prices', [
            'product_id' => $productId,
            'skus' => $skus,
        ]);
    }

    /**
     * @param array $params
     * @param array{id: string, stock_infos: array{available_stock: int}> $skus
     *
     * @return mixed|\Yeejiawei\TiktokShopApi\Response
     */
    public function updateStock(string $productId, array $skus = [])
    {
        return $this->put('/stocks', [
            'product_id' => $productId,
            'skus' => $skus,
        ]);
    }

    public function deleteProducts(array $params = [])
    {
        return $this->delete('/', $params);
    }

    public function recoverProduct(array $params = [])
    {
        return $this->post('/recover', $params);
    }

    public function activateProducts(array $productIds = [])
    {
        return $this->post('/activate', ['product_ids' => $productIds]);
    }

    public function deactivateProducts(array $productIds = [])
    {
        return $this->post('/inactivated_products', ['product_ids' => $productIds]);
    }
}
