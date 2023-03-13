<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Repositories\Interfaces\CategoryRepoInterface;
use App\Util\Interfaces\Connection;

class CategoryRepository implements CategoryRepoInterface
{
    private $conn;

    public function __construct(private Connection $dbInstance)
    {
        $this->conn = $dbInstance->connect();
    }

    public function getGroupByCategoryWithTotalItems(): array
    {
        $sql = 'SELECT icr.category_id, cat.name, icr.total_items FROM (
                SELECT category_id, count(*) as total_items
                FROM `item_category_relations`
                GROUP BY category_id
            ) as icr
            JOIN category as cat ON cat.id = icr.category_id
            ORDER BY total_items DESC';

        $result = $this->conn->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllWithTotalItems(): array
    {
        $sql = 'SELECT c.id, c.name, c.number, cr.parent_category_id, COUNT(icr.id) AS total_items
                FROM category as c
                LEFT JOIN category_relations as cr ON c.Id = cr.category_id
                LEFT JOIN item_category_relations as icr ON c.Id = icr.category_id
                WHERE c.disabled = 0
                GROUP BY c.id';

        $result = $this->conn->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
