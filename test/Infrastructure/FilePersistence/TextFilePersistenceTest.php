<?php

declare(strict_types=1);

namespace Test\Diogo\PdiAdapter\Infrastructure\FilePersistence;

use Diogo\PdiAdapter\Infrastructure\FilePersistence\TextFilePersistence;
use PHPUnit\Framework\TestCase;
use Diogo\PdiAdapter\Domain\ClientData;

final class TextFilePersistenceTest extends TestCase
{
    /** @test */
    public function shouldSaveAsExpected(): void
    {
        $expectedData =
        [
            0 => '1',
            1 => 'Test',
            2 => 'test@test.com',
            3 => '',
        ];
        $clientData = new ClientData($id = '1', $name = 'Test', $email = 'test@test.com');
        
        $controller = new TextFilePersistence();
        $controller->save($clientData);
        $list = $controller->list();

        $this->assertEquals($expectedData, $list);
        unlink(TextFilePersistence::FILE);
    }

    /** @test */
    public function shouldThrowExceptionIfPersisteFileDoesNotExist(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('File not found.');

        $controller = new TextFilePersistence();
        $controller->list();
    }
}
