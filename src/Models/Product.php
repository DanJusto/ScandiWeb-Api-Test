<?php

namespace Scandiweb\Test\Models;

abstract class Product
{
    public string $sku;
    public string $name;
    public string $type;
    public float $price;
    public string $attribute;

    public function __construct(string $sku, string $name, string $type, float $price, string $attribute)
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->type = $type;
        $this->price = $price;
        $this->attribute = $attribute;
    }

    final protected function validateSku(string $sku)
    {
        if ($sku === 'exist') {
            echo "SKU already in use.";
            exit();
        }
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
    public function getType(): string
    {
        return $this->type;
    }

    abstract public function getAttribute(): string;

    abstract public function setId(int $id): void;

    abstract public function getId(): int;
}