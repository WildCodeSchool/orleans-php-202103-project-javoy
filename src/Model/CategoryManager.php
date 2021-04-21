<?php

namespace App\Model;

class CategoryManager extends AbstractManager

{
public const TABLE = 'category'; 

        public function listCategory(): void
        {
            $categoryManager = new CategoryManager();
            $categories = $categoryManager->selectAll();
        }
}