<?php

declare(strict_types=1);

namespace Diogo\PdiAdapter\Application\PaymentProcessor\PaymentType;

use Diogo\PdiAdapter\Application\API\Consume\CreditCardPaymentTypeRequest;
use Diogo\PdiAdapter\Domain\PaymentData;
use Psr\Http\Message\ResponseInterface;

final class CreditCardPaymentType implements PaymentTypeInterface
{
	private const REQUEST_METHOD = 'PUT';
	private const REQUEST_URI = 'https://run.mocky.io/v3/fb5e99ac-c6a3-4cc4-a720-a14effece02a';

	public function processRequest(PaymentData $payment): ResponseInterface
	{
		$creditCardPaymentTypeRequest = new CreditCardPaymentTypeRequest(
			$payment,
			self::REQUEST_METHOD,
			self::REQUEST_URI
		);

		return $creditCardPaymentTypeRequest->dispatchRequest();
	}
}
