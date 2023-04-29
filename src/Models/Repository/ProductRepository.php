<?php

namespace Scandiweb\Test\Models\Repository;

use Scandiweb\Test\Models\Product;

interface ProductRepository
{
    public function findAllProducts(): array;

    public function findProductBySku($sku): array;

    public function add(Product $product): bool;

    public function remove(array $ids);
}