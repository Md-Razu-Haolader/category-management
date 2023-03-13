<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

interface CategoryRepoInterface
{
    public function getGroupByCategoryWithTotalItems(): array;

    public function getAllWithTotalItems(): array;
}
