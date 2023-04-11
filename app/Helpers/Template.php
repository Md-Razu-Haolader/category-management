<?php

declare(strict_types=1);

namespace App\Helpers;

class Template
{
    public function render(string $filePath, $data = [])
    {
        $filePath = __DIR__.'/../Views/'.$filePath;
        if (file_exists($filePath)) {
            require_once $filePath;
        } else {
            throw new \RuntimeException('View file not found');
        }
    }
}
