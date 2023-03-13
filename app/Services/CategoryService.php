<?php

declare(strict_types=1);

namespace App\Services;

use App\Proxies\TemplateHelper;
use App\Repositories\Interfaces\CategoryRepoInterface;

class CategoryService
{
    private $repository;

    public function __construct(private CategoryRepoInterface $categoryRepo)
    {
        $this->repository = $categoryRepo;
    }

    public function getCategoriesWithTotalItems(): void
    {
        $categories = $this->repository->getGroupByCategoryWithTotalItems();
        TemplateHelper::render('category_list.php', $categories);
    }
}
