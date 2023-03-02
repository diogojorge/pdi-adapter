<?php

declare(strict_types=1);

namespace Test\Diogo\PdiAdapter\Domain;

use Diogo\PdiAdapter\Domain\ClientData;
use PHPUnit\Framework\TestCase;

final class ClientDataTest extends TestCase
{
    /** @test */
    public function shouldCreateAsExpected(): void
    {
        $expectedId = '1';
        $expectedName = 'Test';
        $expectedEmail = 'test@test.com';

        $client = new ClientData($expectedId, $expectedName, $expectedEmail);

        $this->assertEquals($expectedId, $client->getId());
        $this->assertEquals($expectedName, $client->getName());
        $this->assertEquals($expectedEmail, $client->getEmail());
    }
}
