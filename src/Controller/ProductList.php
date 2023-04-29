<?php

namespace Scandiweb\Test\Controller;

use Scandiweb\Test\Infra\PdoProductRepository;

class ProductList implements Controller
{
    public function __construct(private PdoProductRepository $productRepo)
    {
    }

    public function processRequest()
    {
        $result = $this->productRepo->findAllProducts();

        $res['status_code_header'] = 'HTTP/1.1 200 OK';
        $res['body'] = json_encode($result);

        $response = json_encode($res);
        
        return $response;
    }
}