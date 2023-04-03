<?php

declare(strict_types=1);

namespace Test;

use Diogo\PdiAdapter\Infrastructure\DBMSPersistence\SQLiteDBMSPersistence;
use PHPUnit\Framework\TestCase;

class PDITestCase extends TestCase
{
    /**
     * @before
     * @after
    */
    public function setup(): void
    {
        $db = SQLiteDBMSPersistence::SQLITEDB;
        if (file_exists($db)) {
            unlink($db);
        }
    }
}
