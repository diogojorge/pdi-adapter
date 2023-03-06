<?php

declare(strict_types=1);

namespace Test\Diogo\PdiAdapter\Application;

use Diogo\PdiAdapter\Application\DBMSPersistenceAdapter;
use Diogo\PdiAdapter\Application\FilePersistenceController;
use Diogo\PdiAdapter\Domain\ClientData;
use Diogo\PdiAdapter\Infrastructure\DBMSPersistence\SQLiteDBMSPersistence;
use Diogo\PdiAdapter\Infrastructure\FilePersistence\CsvFilePersistence;
use Diogo\PdiAdapter\Infrastructure\FilePersistence\FilePersistenceInterface;
use Diogo\PdiAdapter\Infrastructure\FilePersistence\TextFilePersistence;
use PHPUnit\Framework\TestCase;

final class DBMSPersistenceAdapterTest extends TestCase
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
        unlink(SQLiteDBMSPersistence::SQLITEDB);
    }
}
