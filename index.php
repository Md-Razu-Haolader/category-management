<?php

declare(strict_types=1);
require __DIR__ . '/config/bootstrap.php';

use App\Util\DbConnection;
use App\Repositories\CategoryRepository;
use App\Services\CategoryService;
use App\Services\CategoryTreeService;

$dbInstance = DbConnection::getInstance();
$categoryRepo = new CategoryRepository($dbInstance);

if ($_SERVER['REQUEST_URI'] === '/category-tree') {
    $categoryTreeService = new CategoryTreeService($categoryRepo);
    $categoryTreeService->fetch();
} else {
    $categoryService = new CategoryService($categoryRepo);
    $categoryService->getCategoriesWithTotalItems();
}
