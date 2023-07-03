<?php

declare(strict_types=1);

namespace Diogo\PdiAdapter\Application\API\Consume;

use Diogo\PdiAdapter\Domain\PaymentData;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;

abstract class ConsumeParentRequest
{
	public function __construct(
		protected PaymentData $payment,
		protected string $requestMethod,
		protected string $requestUri,
		protected Client $client = new Client()
	) {
	}

	public function dispatchRequest(): ResponseInterface
	{
		$request = $this->buildRequest();

		return $this->client->send($request, $this->requestConfigs());
	}

	private function buildRequest(): Request
	{
		return new Request(
			$this->requestMethod,
			$this->requestUri,
			$this->composeRequestHeader(),
			$this->composeRequestBody(),
		);
	}

	/** @return array<string, string> */
	abstract protected function composeRequestHeader(): array;

	abstract protected function composeRequestBody(): string;

	/** @return array<string, int> */
	abstract protected function requestConfigs(): array;
}
