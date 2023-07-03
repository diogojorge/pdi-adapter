<?php

declare(strict_types=1);

namespace Diogo\PdiAdapter\Application\PaymentProcessor\PaymentType;

use Diogo\PdiAdapter\Domain\PaymentData;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

final class BoletoPaymentType implements PaymentTypeInterface
{
	public function processRequest(PaymentData $payment): ResponseInterface
	{
		$body = json_encode(['id' => "{$payment->getId()}", 'status' => 'OK',]);

		return new Response(200, ['Content-Type' => 'application/json'], $body);
	}
}
