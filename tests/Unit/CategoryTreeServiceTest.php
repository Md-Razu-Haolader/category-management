<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Repositories\CategoryRepository;
use App\Services\CategoryTreeService;
use PHPUnit\Framework\TestCase;

final class CategoryTreeServiceTest extends TestCase
{
    private object $categoryTreeService;

    public static function setUpBeforeClass(): void
    {
    }

    protected function setUp(): void
    {
        $categoryRepo = $this->getMockBuilder(CategoryRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->categoryTreeService = new CategoryTreeService($categoryRepo);
    }

    protected function tearDown(): void
    {
    }

    public function testShouldGiveValidHierarchyCategory()
    {
        $reflector = new ReflectionClass($this->categoryTreeService);
        $method = $reflector->getMethod('makeHierarchyCategory');
        $method->setAccessible(true);
        $categories = [
            ['id' => 1, 'parent_category_id' => 0, 'name' => 'Category A', 'total_items' => 2],
            ['id' => 2, 'parent_category_id' => 1, 'name' => 'Category A1', 'total_items' => 3],
            ['id' => 3, 'parent_category_id' => 1, 'name' => 'Category A2', 'total_items' => 3],
            ['id' => 4, 'parent_category_id' => 3, 'name' => 'Category A3', 'total_items' => 4],
            ['id' => 5, 'parent_category_id' => 3, 'name' => 'Category A4', 'total_items' => 2],
            ['id' => 6, 'parent_category_id' => 5, 'name' => 'Category A5', 'total_items' => 3],
            ['id' => 7, 'parent_category_id' => 2, 'name' => 'Category A6', 'total_items' => 2],
            ['id' => 8, 'parent_category_id' => 0, 'name' => 'Category B', 'total_items' => 2],
            ['id' => 9, 'parent_category_id' => 8, 'name' => 'Category B1', 'total_items' => 3],
            ['id' => 10, 'parent_category_id' => 8, 'name' => 'Category B2', 'total_items' => 2],
            ['id' => 11, 'parent_category_id' => 10, 'name' => 'Category B3', 'total_items' => 3],
            ['id' => 12, 'parent_category_id' => 11, 'name' => 'Category B4', 'total_items' => 3],
        ];

        $result = $method->invokeArgs($this->categoryTreeService, [$categories]);
        $this->assertEquals(true, isset($result[0]['sub_category']));
        $this->assertEquals(2, count($result[0]['sub_category']));
    }

    public function testShouldGiveEmptyArrayWhenEmptyCategoryProvided()
    {
        $reflector = new ReflectionClass($this->categoryTreeService);
        $method = $reflector->getMethod('makeHierarchyCategory');
        $method->setAccessible(true);
        $categories = [];

        $result = $method->invokeArgs($this->categoryTreeService, [$categories]);
        $this->assertEquals([], $result);
    }

    public function testShouldGiveValidCategoryWithTotalItemCalculations()
    {
        $reflector = new ReflectionClass($this->categoryTreeService);
        $method = $reflector->getMethod('getCategoryWithTotaItemCalculations');
        $method->setAccessible(true);
        $categories = ['id' => 1, 'parent_category_id' => 0, 'name' => 'Category A', 'total_items' => 2];

        $result = $method->invokeArgs($this->categoryTreeService, [$categories, 3]);
        $this->assertEquals(true, isset($result['total_items_with_sub_cat']));
        $this->assertEquals(5, $result['total_items_with_sub_cat']);
    }

    public function testTotalItemOfSubCategoryIsZeroWhenTotalItemsParamNotProvided()
    {
        $reflector = new ReflectionClass($this->categoryTreeService);
        $method = $reflector->getMethod('getCategoryWithTotaItemCalculations');
        $method->setAccessible(true);
        $categories = ['id' => 1, 'parent_category_id' => 0, 'name' => 'Category A', 'total_items' => 2];

        $result = $method->invokeArgs($this->categoryTreeService, [$categories]);
        $this->assertEquals(true, isset($result['total_items_of_sub_cat']));
        $this->assertEquals(0, $result['total_items_of_sub_cat']);
    }
}
