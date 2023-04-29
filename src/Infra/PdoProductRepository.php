<?php

namespace Scandiweb\Test\Infra;

use Scandiweb\Test\Models\Repository\ProductRepository;
use Scandiweb\Test\Models\Product;
use Scandiweb\Test\Models\Book;
use Scandiweb\Test\Models\Dvd;
use Scandiweb\Test\Models\Furniture;
use PDO;

class PdoProductRepository implements ProductRepository
{
    public function __construct(private PDO $db)
    {
    }

    public function findAllProducts(): array
    {
        $sqlQuery = 'SELECT * FROM products;';
        $stmt = $this->db->query($sqlQuery);

        return $this->hydrateProductList($stmt);
    }

    public function findProductBySku($sku): array
    {
        $sqlQuery = 'SELECT * FROM products WHERE sku = ?;';
        $stmt = $this->db->prepare($sqlQuery);
        $stmt->bindValue(1, $sku);
        $stmt->execute();

        return $this->hydrateProductList($stmt);
    }

    private function hydrateProductList(\PDOStatement $stmt): array
    {
        $productTypesClass = require __DIR__ . '/../Models/Config/ProductTypes.php';
        $productList = [];
        $productDataList = $stmt->fetchAll();
        
        if (count($productDataList) === 0) {
            return $productList;
        } 

        foreach ($productDataList as $productData) {
            $type = $productData['type'];
            $id = $productData['id'];
            $productClass = $productTypesClass[$type];
            
            $product = new $productClass(
                $productData['sku'],
                $productData['name'],
                $type,
                (float) $productData['price'],
                $productData['attribute']
            );
            
            $product->setId($id);
            
            $productList[] = $product;
        }
        
        return $productList;
    }

    public function add(Product $product): bool
    {
        $sku = $product->getSku();

        $insertQuery = 'INSERT INTO products (sku, name, type, price, attribute) VALUES (:sku, :name, :type, :price, :attribute);';

        $stmt = $this->db->prepare($insertQuery);
        $success = $stmt->execute([
            ':sku' => $sku,
            ':name' => $product->getName(),
            ':type' => $product->getType(),
            ':price' => $product->getPrice(),
            ':attribute' => $product->getAttribute(),
        ]);

        return $success;
    }

    public function remove(array $ids): array
    {   
        $success = [];

        foreach ($ids as $id)
        {
            $stmt = $this->db->prepare('DELETE FROM products WHERE id = ?;');
            $stmt->bindValue(1, $id, PDO::PARAM_INT);
            $success[] = $stmt->execute();
        }

        return $success;
    }
}