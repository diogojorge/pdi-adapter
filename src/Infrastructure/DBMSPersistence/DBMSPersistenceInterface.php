<?php

declare(strict_types=1);

namespace Diogo\PdiAdapter\Infrastructure\DBMSPersistence;

use Diogo\PdiAdapter\Domain\ClientData;

interface DBMSPersistenceInterface
{
    public function insert(ClientData $clientData): void;

    /** @return array<int, string> */
    public function show(): array;
}
