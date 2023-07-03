<?php

declare(strict_types=1);

namespace Diogo\PdiAdapter\Application\API\Consume;

final class CreditCardPaymentTypeRequest extends ConsumeParentRequest
{
	private const REQUEST_CONFIGS = [
		'timeout' => 5,
	];

	/** @return array<string, string> */
	protected function composeRequestHeader(): array
	{
		return ['Content-Type' => 'application/json'];
	}

	protected function composeRequestBody(): string
	{
		return json_encode([
			'paymentId' => $this->payment->getId(),
			'description' => $this->payment->getDescription(),
			'amount' => $this->payment->getAmount(),
		]);
	}

	/** @return array<string, int> */
	protected function requestConfigs(): array
	{
		return self::REQUEST_CONFIGS;
	}
}
