<?php

declare(strict_types=1);

namespace Test;

use Diogo\PdiAdapter\Infrastructure\DBMSPersistence\SQLiteDBMSPersistence;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Before;
use PHPUnit\Framework\Attributes\After;

class PDITestCase extends TestCase
{
	#[Before, After]
	public function clearFakeSQLiteDBs(): void
	{
		$db = SQLiteDBMSPersistence::SQLITEDB;
		if (file_exists($db)) {
			unlink($db);
		}
	}
}
