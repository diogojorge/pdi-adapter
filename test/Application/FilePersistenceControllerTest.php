<?php

declare(strict_types=1);

namespace Test\Diogo\PdiAdapter\Application;

use Diogo\PdiAdapter\Application\FilePersistenceController;
use Diogo\PdiAdapter\Domain\ClientData;
use Diogo\PdiAdapter\Infrastructure\FilePersistence\CsvFilePersistence;
use Diogo\PdiAdapter\Infrastructure\FilePersistence\FilePersistenceInterface;
use Diogo\PdiAdapter\Infrastructure\FilePersistence\TextFilePersistence;
use PHPUnit\Framework\TestCase;

final class FilePersistenceControllerTest extends TestCase
{
    /** @return \Generator<string, mixed> */
    public static function providesPersistencies(): iterable
    {
        yield 'CSV File' => [
            new CsvFilePersistence(),
            [0 => '1,Test,test@test.com',],
            CsvFilePersistence::FILE,
        ];
        yield 'Text File' => [
            new TextFilePersistence(),
            [
                0 => '1',
                1 => 'Test',
                2 => 'test@test.com',
                3 => '',
            ],
            TextFilePersistence::FILE,
        ];
    }
    /**
     * @test
     * @dataProvider providesPersistencies
     * @param array<int, mixed> $expectedList
    */
    public function filePersistenciesShouldSaveAndListAsExpected(
        FilePersistenceInterface $persistenceClass,
        array $expectedList,
        string $persistence
    ): void {
        $clientData = new ClientData($id = '1', $name = 'Test', $email = 'test@test.com');

        $controller = new FilePersistenceController($persistenceClass);
        $controller->save($clientData);
        $list = $controller->list();

        $this->assertEquals($expectedList, $list);
        unlink($persistence);
    }

    /** @return \Generator<string, mixed> */
    public static function providesPersistenciesWithoutFile(): iterable
    {
        yield 'CSV File' => [new CsvFilePersistence(),];
        yield 'Text File' => [new TextFilePersistence(),];
    }

    /**
     * @test
     * @dataProvider providesPersistenciesWithoutFile
    */
    public function filePersistenciesShouldThrowExceptionIfPersisteFileDoesNotExist(
        FilePersistenceInterface $persistenceClass
    ): void {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('File not found.');

        $controller = new FilePersistenceController($persistenceClass);
        $controller->list();
    }
}
