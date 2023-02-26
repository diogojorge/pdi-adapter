<?php

declare(strict_types=1);

namespace Test\Diogo\PdiAdapter\Application;

use Diogo\PdiAdapter\Application\Controller;
use Diogo\PdiAdapter\Domain\Client;
use PHPUnit\Framework\TestCase;

final class ControllerTest extends TestCase
{
    /** @test */
    public function shouldSaveAndListAsExpected(): void
    {
        $client = new Client(
            $expectedId = '1',
            $expectedName = 'Test',
            $expectedEmail = 'test@test.com'
        );
        $expectedOutput = '1' .  PHP_EOL . 'Test' . PHP_EOL . 'test@test.com' . PHP_EOL . PHP_EOL;

        $this->expectOutputString($expectedOutput);
        Controller::save($client);
        Controller::list();
    }

    /** @after */
    public function clean(): void
    {
        unlink(Controller::FILE);
    }
}
