<?php

declare(strict_types=1);

namespace Test\Diogo\PdiAdapter\Application;

use Diogo\PdiAdapter\Application\DBMSPersistenceInsertCommand;
use Diogo\PdiAdapter\Application\DBMSPersistenceInvoker;
use Diogo\PdiAdapter\Application\DBMSPersistenceShowCommand;
use Diogo\PdiAdapter\Domain\ClientData;
use Diogo\PdiAdapter\Infrastructure\DBMSPersistence\SQLiteDBMSPersistence;
use Test\PDITestCase;

final class DBMSPersistenceInvokerTest extends PDITestCase
{
    /**
     * @test
    */
    public function shouldInsertAndShowDataAsExpected(): void
    {
        $clientData = new ClientData($id = '1', $name = 'Test', $email = 'test@test.com');
        $expectedClientDataArray = [0 => '1,Test,test@test.com'];
        $persistence = new SQLiteDBMSPersistence();
        $invoker = new DBMSPersistenceInvoker();
        $invoker->setInsertCommand(new DBMSPersistenceInsertCommand($persistence, $clientData));
        $invoker->setShowCommand(new DBMSPersistenceShowCommand($persistence));

        $invokerResult = $invoker->insertAndShowData();

        $this->assertEquals($expectedClientDataArray, $invokerResult);
    }
}
