<?php

declare(strict_types=1);

namespace Test\Diogo\PdiAdapter\Application;

use Diogo\PdiAdapter\Application\DBMSPersistenceAdapter;
use Diogo\PdiAdapter\Domain\ClientData;
use Diogo\PdiAdapter\Infrastructure\DBMSPersistence\SQLiteDBMSPersistence;
use Diogo\PdiAdapter\Application\Commons\EnvironmentEnum;
use Test\PDITestCase;
use PHPUnit\Framework\Attributes\Test;

final class DBMSPersistenceAdapterTest extends PDITestCase
{
    #[Test]
    public function dBMSPersistenceShouldSaveAndListAsExpected(): void
    {
        $expectedData = [0 => '1,Test,test@test.com',];
        $clientData = new ClientData($id = '1', $name = 'Test', $email = 'test@test.com');


        $controller = new DBMSPersistenceAdapter(new SQLiteDBMSPersistence(EnvironmentEnum::fromEnvironment('TEST')));
        $controller->save($clientData);
        $list = $controller->list();

        $this->assertEquals($expectedData, $list);
    }
}
