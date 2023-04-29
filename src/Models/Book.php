<?php

namespace Scandiweb\Test\Models;

class Book extends Product
{
    public readonly int $id;

    public function __construct(string $sku, string $name, string $type,float $price, string $attribute)
    {
        parent::__construct($sku, $name, $type, $price, $attribute);
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getAttribute(): string
    {
        return $this->attribute;
    }
}