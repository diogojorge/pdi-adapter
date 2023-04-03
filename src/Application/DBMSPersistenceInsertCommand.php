<?php

declare(strict_types=1);

namespace Diogo\PdiAdapter\Application;

use Diogo\PdiAdapter\Domain\ClientData;
use Diogo\PdiAdapter\Infrastructure\DBMSPersistence\DBMSPersistenceInterface;

final class DBMSPersistenceInsertCommand implements DBMSPersistenceCommandInterface
{
    public function __construct(
        private DBMSPersistenceInterface $receiver,
        private ClientData $clientData
    ) {
    }

    public function execute(): void
    {
        $this->receiver->insert($this->clientData);
    }
}
