<?php

declare(strict_types=1);

namespace Test\Diogo\PdiAdapter\Domain;

use Diogo\PdiAdapter\Domain\PaymentData;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;

final class PaymentDataTest extends TestCase
{
    #[Test]
    public function shouldCreateAsExpectedAndSetNewStatus(): void
    {
        $expectedId = '1';
        $expectedDescription = 'Test';
        $expectedAmount = 10.99;

        $payment = new PaymentData($expectedId, $expectedDescription, $expectedAmount);

        $this->assertEquals($expectedId, $payment->getId());
        $this->assertEquals($expectedDescription, $payment->getDescription());
        $this->assertEquals($expectedAmount, $payment->getAmount());
        $this->assertEquals($expectedStatus = 'open', $payment->getStatus());

		$newStatus = 'pending';

		$payment->setStatus($newStatus);

		$this->assertEquals($newStatus, $payment->getStatus());
    }
}
