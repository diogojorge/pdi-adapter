<?php

declare(strict_types=1);

namespace Test\Diogo\PdiAdapter\Application\PaymentProcessor\PaymentType;

use Diogo\PdiAdapter\Application\PaymentProcessor\PaymentType\CreditCardPaymentType;
use Diogo\PdiAdapter\Domain\PaymentData;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;

final class CreditCardPaymentTypeTest extends TestCase
{
	#[Test]
	public function processRequestShouldReturnExpectedResponse(): void
	{
		$payment = new PaymentData('1', 'produto', 10);
		$expectedResponse = json_encode($this->getExpectedResponse($payment), JSON_PRETTY_PRINT);

		$response = (new CreditCardPaymentType())->processRequest($payment);

		$this->assertEquals(200, $response->getStatusCode());
		$this->assertEquals($expectedResponse, (string)$response->getBody());
	}

	/** @return array<string, mixed> */
	private function getExpectedResponse(PaymentData $payment): array
	{
		return ['id' => (int)$payment->getId(), 'status' => 'OK',];
	}
}
