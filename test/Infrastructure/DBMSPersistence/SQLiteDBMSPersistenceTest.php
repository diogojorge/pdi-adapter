<?php

declare(strict_types=1);

namespace Test\Diogo\PdiAdapter\Infrastructure\DBMSPersistence;

use Diogo\PdiAdapter\Domain\ClientData;
use Diogo\PdiAdapter\Infrastructure\DBMSPersistence\SQLiteDBMSPersistence;
use Diogo\PdiAdapter\Application\Commons\EnvironmentEnum;
use Test\PDITestCase;
use PHPUnit\Framework\Attributes\Test;

final class SQLiteDBMSPersistenceTest extends PDITestCase
{
    #[Test]
    public function shouldSaveAsExpected(): void
    {
        $expectedShowResult = [0 => '1,Test,test@test.com',];
		$clientData = new ClientData(
			$id = '1',
			$name = 'Test',
			$email = 'test@test.com',
			$cpf = '11111111111',
			$lastCpfValidation = '2023-08-01 06:00:00'
		);

        $controller = new SQLiteDBMSPersistence(EnvironmentEnum::fromEnvironment('TEST'));
        $controller->insert($clientData);
        $showResult = $controller->show();

        $this->assertEquals($expectedShowResult, $showResult);
    }

	#[Test]
    public function shouldVerifyIfIsClientEmailRegistered(): void
    {
		$clientData = new ClientData(
			$id = '1',
			$name = 'Test',
			$email = 'test@test.com',
			$cpf = '11111111111',
			$lastCpfValidation = '2023-08-01 06:00:00'
		);

        $controller = new SQLiteDBMSPersistence(EnvironmentEnum::fromEnvironment('TEST'));
        $controller->insert($clientData);
        $isClientEmailRegistered = $controller->isClientEmailRegistered($email);

        $this->assertTrue($isClientEmailRegistered);
    }
}
