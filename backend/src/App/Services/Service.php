<?php

declare(strict_types=1);

namespace Source\App\Services;

use PDOException;

abstract class Service
{
    protected function handleSuccess(array $data = []): array
    {
        return [
            'success' => true,
            $data,
        ];
    }

    protected function handleException(PDOException $e): array
    {
        return [
            'success' => false,
            $e,
        ];
    }
}
