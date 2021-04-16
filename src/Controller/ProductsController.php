<?php

namespace App\Controller;

class ProductsController extends AbstractController
{
    // Display list of products
    public function index()
    {
        return $this->twig->render('Products/index.html.twig');
    }
}
