<?php

declare(strict_types=1);

namespace Diogo\PdiAdapter\Application\PaymentProcessor;

use Diogo\PdiAdapter\Application\PaymentProcessor\PaymentType\PaymentTypeInterface;
use Diogo\PdiAdapter\Domain\PaymentData;
use Psr\Http\Message\ResponseInterface;

final class PaymentProcessor
{
	public function __construct()
	{
	}

	public function execute(PaymentData $payment, PaymentTypeInterface $paymentType): ResponseInterface
	{
		return ($paymentType)->processRequest($payment);
	}

	/** @psalm-suppress MixedAssignment, MixedArrayAccess */
	public function validateResponse(ResponseInterface $response): bool
	{
		$body = (string)$response->getBody();
		$arrayBody = json_decode($body, true);
		if ($arrayBody['status'] === 'OK') {
			return true;
		}
		return false;
	}
}
