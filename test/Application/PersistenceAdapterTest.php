<?php

declare(strict_types=1);

namespace Test\Diogo\PdiAdapter\Application;

use Diogo\PdiAdapter\Application\PersistenceAdapter;
use Diogo\PdiAdapter\Domain\Client;
use Diogo\PdiAdapter\Infrastructure\CsvFilePersistence;
use Diogo\PdiAdapter\Infrastructure\PersistenceInterface;
use Diogo\PdiAdapter\Infrastructure\TextFilePersistence;
use PHPUnit\Framework\TestCase;

final class PersistenceAdapterTest extends TestCase
{
    /** @return \Generator<string, mixed> */
    public function providesPersistencies(): iterable
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
        PersistenceInterface $persistenceClass,
        array $expectedList,
        string $persistence
    ): void {
        $client = new Client($id = '1', $name = 'Test', $email = 'test@test.com');
        
        $controller = new PersistenceAdapter($persistenceClass);
        $controller->save($client);
        $list = $controller->list();

        $this->assertEquals($expectedList, $list);
        unlink($persistence);
    }

    /** @return \Generator<string, mixed> */
    public function providesPersistenciesWithoutFile(): iterable
    {
        yield 'CSV File' => [new CsvFilePersistence(),];
        yield 'Text File' => [new TextFilePersistence(),];
    }

    /**
     * @test
     * @dataProvider providesPersistenciesWithoutFile
    */
    public function filePersistenciesShouldThrowExceptionIfPersisteFileDoesNotExist(
        PersistenceInterface $persistenceClass
    ): void {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('File not found.');

        $controller = new PersistenceAdapter($persistenceClass);
        $controller->list();
    }
}
