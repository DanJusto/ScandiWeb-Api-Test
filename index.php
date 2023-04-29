<?php

header("Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

require_once 'autoload.php';

use Scandiweb\Test\Infra\Connection;
use Scandiweb\Test\Infra\PdoProductRepository;
use Scandiweb\Test\Controller\DeleteProduct;
use Scandiweb\Test\Controller\NewProduct;
use Scandiweb\Test\Controller\ProductList;

$db = Connection::createConnection();
$productRepo = new PdoProductRepository($db);

$routes = require_once __DIR__ . '/config/routes.php';

$httpMethod = $_SERVER['REQUEST_METHOD'];

if ($httpMethod === 'OPTIONS') {

  header("Content-Type: application/json");
  header( 'Access-Control-Max-Age: 86400' );
  header( 'Vary: origin' );
  header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

  return http_response_code(204);
}

$pathInfo = $_SERVER['PATH_INFO'] ?? '/';

$key = "$httpMethod|$pathInfo";

$controllerClass = $routes[$key];
$controller = new $controllerClass($productRepo);

$result = $controller->processRequest();
echo $result;

die();