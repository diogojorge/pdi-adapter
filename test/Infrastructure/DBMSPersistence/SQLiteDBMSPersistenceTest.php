<?php

declare(strict_types=1);

namespace Test\Diogo\PdiAdapter\Infrastructure\DBMSPersistence;

use Diogo\PdiAdapter\Domain\ClientData;
use Diogo\PdiAdapter\Infrastructure\DBMSPersistence\SQLiteDBMSPersistence;
use PHPUnit\Framework\TestCase;

final class SQLiteDBMSPersistenceTest extends TestCase
{
    /** @test */
    public function shouldSaveAsExpected(): void
    {
        $expectedShowResult = [0 => '1,Test,test@test.com',];
        $clientData = new ClientData($id = '1', $name = 'Test', $email = 'test@test.com');
        
        $controller = new SQLiteDBMSPersistence();
        $controller->insert($clientData);
        $showResult = $controller->show();

        $this->assertEquals($expectedShowResult, $showResult);
        unlink(SQLiteDBMSPersistence::SQLITEDB);
    }
}
