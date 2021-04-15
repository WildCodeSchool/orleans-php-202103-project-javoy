<?php

namespace App\Controller;

use App\Model\ProductManager;

class ProductController extends AbstractController
{
    public function listProduct(): string
    {
        $productManager = new ProductManager();
        $products = $productManager->selectAll();
        return $this->twig->render("Item/_listProduct.html.twig", ["product" => $products]);
    }
}
