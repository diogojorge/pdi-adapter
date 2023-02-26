<?php

declare(strict_types=1);

namespace Test\Diogo\PdiAdapter\Domain;

use Diogo\PdiAdapter\Domain\Client;
use PHPUnit\Framework\TestCase;

final class ClientTest extends TestCase
{
    /** @test */
    public function shouldCreateAsExpected(): void
    {
        $expectedId = '1';
        $expectedName = 'Test';
        $expectedEmail = 'test@test.com';

        $client = new Client($expectedId, $expectedName, $expectedEmail);

        $this->assertEquals($expectedId, $client->getId());
        $this->assertEquals($expectedName, $client->getName());
        $this->assertEquals($expectedEmail, $client->getEmail());
    }
}
