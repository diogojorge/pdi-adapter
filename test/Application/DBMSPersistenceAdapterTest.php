<?php

declare(strict_types=1);

namespace Test\Diogo\PdiAdapter\Application;

use Diogo\PdiAdapter\Application\DBMSPersistenceAdapter;
use Diogo\PdiAdapter\Domain\ClientData;
use Diogo\PdiAdapter\Infrastructure\DBMSPersistence\SQLiteDBMSPersistence;
use Test\PDITestCase;

final class DBMSPersistenceAdapterTest extends PDITestCase
{
    /**
     * @test
    */
    public function dBMSPersistenceShouldSaveAndListAsExpected(): void
    {
        $expectedData = [0 => '1,Test,test@test.com',];
        $clientData = new ClientData($id = '1', $name = 'Test', $email = 'test@test.com');

        $controller = new DBMSPersistenceAdapter(new SQLiteDBMSPersistence());
        $controller->save($clientData);
        $list = $controller->list();

        $this->assertEquals($expectedData, $list);
    }
}
