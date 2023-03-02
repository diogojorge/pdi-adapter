<?php

declare(strict_types=1);

namespace Diogo\PdiAdapter\Infrastructure;

use Diogo\PdiAdapter\Domain\ClientData;

interface PersistenceInterface
{
    public static function save(ClientData $clientData): void;

    /** @return array<int, string> */
    public static function list(): array;
}
