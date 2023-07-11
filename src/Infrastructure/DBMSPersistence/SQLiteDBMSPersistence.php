<?php

declare(strict_types=1);

namespace Diogo\PdiAdapter\Infrastructure\DBMSPersistence;

use Diogo\PdiAdapter\Domain\ClientData;
use Diogo\PdiAdapter\Infrastructure\DBMSPersistence\DBMSPersistenceInterface;
use Diogo\PdiAdapter\Application\Commons\EnvironmentEnum;

final class SQLiteDBMSPersistence implements DBMSPersistenceInterface
{
    private \SQLite3 $sqliteDB;

    public function __construct(private EnvironmentEnum $environment)
    {
        $this->sqliteDB = new \SQLite3($this->environment->value, SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
        $this->sqliteDB->query(
            "CREATE TABLE IF NOT EXISTS client (
				nr INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
                id INTEGER NOT NULL,
                name VARCHAR NOT NULL,
                email VARCHAR NOT NULL
            )"
        );
        $this->sqliteDB->close();
    }

    public function insert(ClientData $clientData): void
    {
        $this->sqliteDB = new \SQLite3($this->environment->value, SQLITE3_OPEN_READWRITE);
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
        $this->sqliteDB = new \SQLite3($this->environment->value, SQLITE3_OPEN_READONLY);
        $res = $this->sqliteDB->query("SELECT * FROM client");
        $showResult = [];
        while ($row = $res->fetchArray()) {
            $showResult[] = "{$row['id']},{$row['name']},{$row['email']}";
        }
        $this->sqliteDB->close();
        return $showResult;
    }

	public function isClientEmailRegistered(string $clientEmail): bool
	{
		$this->sqliteDB = new \SQLite3($this->environment->value, SQLITE3_OPEN_READONLY);
        $res = $this->sqliteDB->query("SELECT * FROM client WHERE email = '{$clientEmail}'");
		$row = $res->fetchArray();
		$this->sqliteDB->close();
		if ($row) {
			return true;
		}
		return false;
	}
}
