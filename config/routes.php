<?php

return [
    'GET|/' => \Scandiweb\Test\Controller\ProductList::class,
    'POST|/' => \Scandiweb\Test\Controller\NewProduct::class,
    'DELETE|/' => \Scandiweb\Test\Controller\DeleteProduct::class,
];