<?php

declare(strict_types=1);

namespace Diogo\PdiAdapter\Infrastructure\FilePersistence;

use Diogo\PdiAdapter\Domain\ClientData;

interface FilePersistenceInterface
{
    public function save(ClientData $clientData): void;

    /** @return array<int, string> */
    public function list(): array;
}
