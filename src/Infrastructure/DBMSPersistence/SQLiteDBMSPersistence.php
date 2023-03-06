<?php

declare(strict_types=1);

namespace Diogo\PdiAdapter\Infrastructure\DBMSPersistence;

use Diogo\PdiAdapter\Domain\ClientData;
use Diogo\PdiAdapter\Infrastructure\DBMSPersistence\DBMSPersistenceInterface;

final class SQLiteDBMSPersistence implements DBMSPersistenceInterface
{
    public const SQLITEDB = 'src/Infrastructure/DBMSPersistence/client.sqlite';

    private \SQLite3 $sqliteDB;

    public function __construct()
    {
        $this->sqliteDB = new \SQLite3(self::SQLITEDB, SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
        $this->sqliteDB->query(
            'CREATE TABLE IF NOT EXISTS "client" (
                "nr" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
                "id" INTEGER NOT NULL,
                "name" VARCHAR NOT NULL,
                "email" VARCHAR NOT NULL
            )'
        );
        $this->sqliteDB->close();
    }

    public function insert(ClientData $clientData): void
    {
        $this->sqliteDB = new \SQLite3(self::SQLITEDB, SQLITE3_OPEN_READWRITE);
        $this->sqliteDB->query(
            "INSERT INTO client
                (id, name, email)
            VALUES
            ('{$clientData->getId()}', '{$clientData->getName()}', '{$clientData->getEmail()}')"
        );
        $this->sqliteDB->close();
    }

    /** @return array<int, string> */
    public function show(): array
    {
        $this->sqliteDB = new \SQLite3(self::SQLITEDB, SQLITE3_OPEN_READONLY);
        $res = $this->sqliteDB->query('SELECT * FROM "client"');
        $showResult = [];
        while ($row = $res->fetchArray()) {
            $showResult[] = "{$row['id']},{$row['name']},{$row['email']}";
        }
        $this->sqliteDB->close();
        return $showResult;
    }
}
