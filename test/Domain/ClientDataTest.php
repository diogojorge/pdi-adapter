<?php

declare(strict_types=1);

namespace Test\Diogo\PdiAdapter\Domain;

use Diogo\PdiAdapter\Domain\ClientData;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;

final class ClientDataTest extends TestCase
{
    #[Test]
    public function shouldCreateAsExpected(): void
    {
        $expectedId = '1';
        $expectedName = 'Test';
        $expectedEmail = 'test@test.com';
		$expectedCpf = '11111111111';
		$expectedLastCpfValidation = '2023-08-01 06:00:00';

        $client = new ClientData($expectedId, $expectedName, $expectedEmail, $expectedCpf, $expectedLastCpfValidation);

        $this->assertEquals($expectedId, $client->getId());
        $this->assertEquals($expectedName, $client->getName());
        $this->assertEquals($expectedEmail, $client->getEmail());
        $this->assertEquals($expectedCpf, $client->getCpf());
        $this->assertEquals($expectedLastCpfValidation, $client->getLastCpfValidation());
    }
}
