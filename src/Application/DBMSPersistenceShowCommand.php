<?php

declare(strict_types=1);

namespace Diogo\PdiAdapter\Application;

use Diogo\PdiAdapter\Infrastructure\DBMSPersistence\DBMSPersistenceInterface;

final class DBMSPersistenceShowCommand implements DBMSPersistenceCommandInterface
{
    public function __construct(
        private DBMSPersistenceInterface $receiver
    ) {
    }

    /** @return array<int, string> */
    public function execute(): array
    {
        return $this->receiver->show();
    }
}
