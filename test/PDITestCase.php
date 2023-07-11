<?php

declare(strict_types=1);

namespace Test;

use Diogo\PdiAdapter\Application\Commons\EnvironmentEnum;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Before;
use PHPUnit\Framework\Attributes\After;

class PDITestCase extends TestCase
{
	#[Before, After]
	public function clearFakeSQLiteDBs(): void
	{
		$db = EnvironmentEnum::fromEnvironment('TEST')->value;
		if (file_exists($db)) {
			unlink($db);
		}
	}
}
