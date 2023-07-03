<?php

declare(strict_types=1);

namespace Test\Diogo\PdiAdapter\Application\PaymentProcessor\PaymentType;

use Diogo\PdiAdapter\Application\PaymentProcessor\PaymentType\BoletoPaymentType;
use Diogo\PdiAdapter\Application\PaymentProcessor\PaymentType\EWalletPaymentType;
use Diogo\PdiAdapter\Domain\PaymentData;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;

final class EWalletPaymentTypeTest extends TestCase
{
	#[Test]
	public function processRequestShouldReturnExpectedResponse(): void
	{
		$payment = new PaymentData('1', 'produto', 10);
		$expectedResponse = json_encode($this->getExpectedResponse($payment));

		$response = (new EWalletPaymentType())->processRequest($payment);

		$this->assertEquals(200, $response->getStatusCode());
		$this->assertEquals($expectedResponse, (string)$response->getBody());
	}

	/**
	 * @return array<string, string>
	 */
	private function getExpectedResponse(PaymentData $payment): array
	{
		return ['id' => "{$payment->getId()}", 'status' => 'OK',];
	}
}
