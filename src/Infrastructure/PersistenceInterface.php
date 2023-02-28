<?php

declare(strict_types=1);

namespace Diogo\PdiAdapter\Infrastructure;

use Diogo\PdiAdapter\Domain\Client;

interface PersistenceInterface
{
    public static function save(Client $client): void;

    /** @return array<int, string> */
    public static function list(): array;
}
