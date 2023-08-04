<?php

declare(strict_types=1);

namespace Test\Diogo\PdiAdapter\Application;

use Diogo\PdiAdapter\Application\DBMSPersistenceInsertCommand;
use Diogo\PdiAdapter\Application\DBMSPersistenceInvoker;
use Diogo\PdiAdapter\Application\DBMSPersistenceShowCommand;
use Diogo\PdiAdapter\Domain\ClientData;
use Diogo\PdiAdapter\Infrastructure\DBMSPersistence\SQLiteDBMSPersistence;
use Diogo\PdiAdapter\Application\Commons\EnvironmentEnum;
use Test\PDITestCase;
use PHPUnit\Framework\Attributes\Test;

final class DBMSPersistenceInvokerTest extends PDITestCase
{
    #[Test]
    public function shouldInsertAndShowDataAsExpected(): void
    {
		$clientData = new ClientData(
			$id = '1',
			$name = 'Test',
			$email = 'test@test.com',
			$cpf = '11111111111',
			$lastCpfValidation = '2023-08-01 06:00:00'
		);
        $expectedClientDataArray = [0 => '1,Test,test@test.com'];
        $persistence = new SQLiteDBMSPersistence(EnvironmentEnum::fromEnvironment('TEST'));
        $invoker = new DBMSPersistenceInvoker();
        $invoker->setInsertCommand(new DBMSPersistenceInsertCommand($persistence, $clientData));
        $invoker->setShowCommand(new DBMSPersistenceShowCommand($persistence));

        $invokerResult = $invoker->insertAndShowData();

        $this->assertEquals($expectedClientDataArray, $invokerResult);
    }
}
