<?php

namespace App\Model;

class ProductManager extends AbstractManager
{
    public const TABLE = 'product';

    public function listProduct(): void
    {
        $productManager = new ProductManager();
        $productManager->selectAll();
    }
}
