<?php

namespace Scandiweb\Test\Controller;

use Scandiweb\Test\Infra\PdoProductRepository;

class DeleteProduct implements Controller
{
    public function __construct(private PdoProductRepository $productRepo)
    {
    }
    public function processRequest()
    {
        $ids = json_decode(file_get_contents("php://input"), true);
        
        $result = $this->productRepo->remove($ids);

        $res['status_code_header'] = 'HTTP/1.1 200 OK';
        $res['body'] = json_encode($result);
        $response = json_encode($res);
        
        return $response;
    }
}