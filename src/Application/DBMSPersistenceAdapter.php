<?php

declare(strict_types=1);

namespace Diogo\PdiAdapter\Application;

use Diogo\PdiAdapter\Domain\ClientData;
use Diogo\PdiAdapter\Infrastructure\DBMSPersistence\DBMSPersistenceInterface;
use Diogo\PdiAdapter\Infrastructure\FilePersistence\FilePersistenceInterface;

final class DBMSPersistenceAdapter implements FilePersistenceInterface
{
    private DBMSPersistenceInterface $persistence;

    public function __construct(DBMSPersistenceInterface $persistence)
    {
        $this->persistence = $persistence;
    }

    public function save(ClientData $clientData): void
    {
        $this->persistence->insert($clientData);
    }

    /** @return array<int, string> */
    public function list(): array
    {
        return $this->persistence->show();
    }
}
