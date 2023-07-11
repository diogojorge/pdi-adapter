<?php

declare(strict_types=1);

namespace Test\Diogo\PdiAdapter\Application\Commons;

use Diogo\PdiAdapter\Application\Commons\EnvironmentEnum;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\DataProvider;

final class EnvironmentEnumTest extends TestCase
{
	/** @return \Generator<string, mixed> */
	public static function provideEnvironment(): iterable
	{
		yield 'TEST Environment' => [
			'expectedEnvironment' => 'TEST',
			'expectedSQLiteDB' => 'test/_support/DBMSPersistence/client.sqlite',
		];
		yield 'PRODUCTION Environment' => [
			'expectedEnvironment' => 'PRODUCTION',
			'expectedSQLiteDB' => 'Infrastructure/DBMSPersistence/SQLite/client.sqlite',
		];
	}

    #[Test]
	#[DataProvider('provideEnvironment')]
    public function shouldGetExpectedValue(string $expectedEnvironment, string $expectedSQLiteDB): void
    {
		$environmentName = EnvironmentEnum::fromEnvironment($expectedEnvironment)->name;
		$pathToSQLiteDB  = EnvironmentEnum::fromEnvironment($expectedEnvironment)->value;

		$this->assertEquals($expectedEnvironment, $environmentName);
		$this->assertEquals($expectedSQLiteDB, $pathToSQLiteDB);
	}
}
