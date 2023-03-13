<?php

declare(strict_types=1);

namespace App\Services;

use App\Proxies\TemplateHelper;
use App\Repositories\Interfaces\CategoryRepoInterface;

class CategoryTreeService
{
    private $repository;

    public function __construct(private CategoryRepoInterface $categoryRepo)
    {
        $this->repository = $categoryRepo;
    }

    public function fetch(): void
    {
        $categories = $this->repository->getAllWithTotalItems();
        $catTree = $this->makeHierarchyCategory($categories);
        TemplateHelper::render('category_tree.php', $catTree);
    }

    private function makeHierarchyCategory(array $categories, int $parentId = 0): array
    {
        $result = [];
        foreach ($categories as $category) {
            if ($category['parent_category_id'] == $parentId) {
                $subCategory = $this->makeHierarchyCategory($categories, intval($category['id']));

                if (!empty($subCategory)) {
                    $totalItemOfSubCat = $this->getTotalItemOfSubCategory($subCategory);
                    $category = $this->getCategoryWithTotaItemCalculations($category, $totalItemOfSubCat);
                    $category['sub_category'] = $subCategory;
                }
                $result[] = $category;
            }
        }

        return $result;
    }

    private function getCategoryWithTotaItemCalculations(array $category, int $totalItemOfSubCat = 0): array
    {
        $category['total_items_of_sub_cat'] = $totalItemOfSubCat;
        $category['total_items_with_sub_cat'] = $totalItemOfSubCat + $category['total_items'];
        return $category;
    }

    private function getTotalItemOfSubCategory(array $subCategory): int
    {
        return array_reduce($subCategory, function ($totalItemOfSubCat, $child) {
            if (isset($child['total_items_of_sub_cat'])) {
                $totalItemOfSubCat += $child['total_items_of_sub_cat'] + $child['total_items'];
            } else {
                $totalItemOfSubCat += $child['total_items'];
            }
            return $totalItemOfSubCat;
        });
    }
}
