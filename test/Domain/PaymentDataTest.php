<?php

declare(strict_types=1);

namespace Test\Diogo\PdiAdapter\Domain;

use Diogo\PdiAdapter\Domain\PaymentData;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;

final class PaymentDataTest extends TestCase
{
    #[Test]
    public function shouldCreateAsExpected(): void
    {
        $expectedId = '1';
        $expectedDescription = 'Test';
        $expectedAmount = 10.99;

        $payment = new PaymentData($expectedId, $expectedDescription, $expectedAmount);

        $this->assertEquals($expectedId, $payment->getId());
        $this->assertEquals($expectedDescription, $payment->getDescription());
        $this->assertEquals($expectedAmount, $payment->getAmount());
    }
}
