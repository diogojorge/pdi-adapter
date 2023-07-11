<?php

declare(strict_types=1);

namespace Diogo\PdiAdapter\Application\PaymentProcessor\PaymentType;

use Diogo\PdiAdapter\Application\API\Consume\CreditCardPaymentTypeRequest;
use Diogo\PdiAdapter\Domain\PaymentData;
use Psr\Http\Message\ResponseInterface;

final class CreditCardPaymentType implements PaymentTypeInterface
{
	private const REQUEST_METHOD = 'PUT';
	private const REQUEST_URI = 'https://run.mocky.io/v3/e6465368-bd5d-42ae-916d-89a94982e720';

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
