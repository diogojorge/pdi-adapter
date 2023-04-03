<?php

declare(strict_types=1);

namespace Diogo\PdiAdapter\Application;

use Diogo\PdiAdapter\Infrastructure\DBMSPersistence\DBMSPersistenceInterface;

interface DBMSPersistenceCommandInterface
{
    /** @return mixed */
    public function execute();
}
