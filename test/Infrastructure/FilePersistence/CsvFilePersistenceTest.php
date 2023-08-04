<?php

declare(strict_types=1);

namespace Test\Diogo\PdiAdapter\Infrastructure\FilePersistence;

use Diogo\PdiAdapter\Infrastructure\FilePersistence\CsvFilePersistence;
use PHPUnit\Framework\TestCase;
use Diogo\PdiAdapter\Domain\ClientData;
use PHPUnit\Framework\Attributes\Test;

final class CsvFilePersistenceTest extends TestCase
{
    #[Test]
    public function shouldSaveAsExpected(): void
    {
        $expectedData = [0 => '1,Test,test@test.com',];
		$clientData = new ClientData(
			$id = '1',
			$name = 'Test',
			$email = 'test@test.com',
			$cpf = '11111111111',
			$lastCpfValidation = '2023-08-01 06:00:00'
		);

        $controller = new CsvFilePersistence();
        $controller->save($clientData);
        $list = $controller->list();

        $this->assertEquals($expectedData, $list);
        unlink(CsvFilePersistence::FILE);
    }

    #[Test]
    public function shouldThrowExceptionIfPersisteFileDoesNotExist(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('File not found.');

        $controller = new CsvFilePersistence();
        $controller->list();
    }
}
