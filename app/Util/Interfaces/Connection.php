<?php

declare(strict_types=1);

namespace App\Util\Interfaces;

interface Connection
{
    public static function getInstance(): Connection;

    public function connect();
}
