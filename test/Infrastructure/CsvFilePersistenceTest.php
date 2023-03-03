<?php

declare(strict_types=1);

namespace Test\Diogo\PdiAdapter\Infrastructure;

use Diogo\PdiAdapter\Application\PersistenceAdapter;
use Diogo\PdiAdapter\Infrastructure\CsvFilePersistence;
use PHPUnit\Framework\TestCase;
use Diogo\PdiAdapter\Domain\ClientData;

final class CsvFilePersistenceTest extends TestCase
{
    /** @test */
    public function shouldSaveAsExpected(): void
    {
        $expectedData = [0 => '1,Test,test@test.com',];
        $clientData = new ClientData($id = '1', $name = 'Test', $email = 'test@test.com');
        
        $controller = new PersistenceAdapter(new CsvFilePersistence());
        $controller->save($clientData);
        $list = $controller->list();

        $this->assertEquals($expectedData, $list);
        unlink(CsvFilePersistence::FILE);
    }

    /** @test */
    public function shouldThrowExceptionIfPersisteFileDoesNotExist(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('File not found.');

        $controller = new PersistenceAdapter(new CsvFilePersistence());
        $controller->list();
    }
}
