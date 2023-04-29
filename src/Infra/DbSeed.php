<?php

use Scandiweb\Test\Infra\Connection;

require 'Connection.php';

$db = Connection::createConnection();

$stmt = <<<EOS
  CREATE TABLE IF NOT EXISTS products (
    id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
    sku VARCHAR(100) NOT NULL,
    name VARCHAR(100) NOT NULL,
    type VARCHAR(100) NOT NULL,
    price VARCHAR(100) NOT NULL,
    attribute VARCHAR(100) NOT NULL);

  INSERT INTO products
    (sku, name, type, price, attribute)
  VALUES
    ('DVD00123', 'DVD-Disc', 'dvd', '1.49', '700'),
    ('BOOK0123', 'The Book', 'book', '12', '2'),
    ('FURN0123', 'Chair', 'furniture', '39.99', '130x70x70'),
    ('FURN0456', 'Table', 'furniture', '59.99', '90x100x180');
EOS;
       
try {
  $createTable = $db->exec($stmt);
  echo "Success!\n";
} catch (\PDOException $e) {
  exit($e->getMessage());
}