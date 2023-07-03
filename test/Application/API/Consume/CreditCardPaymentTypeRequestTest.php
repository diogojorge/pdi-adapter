<?php

declare(strict_types=1);

namespace Test\Diogo\PdiAdapter\Application\API\Consume;

use Diogo\PdiAdapter\Application\API\Consume\CreditCardPaymentTypeRequest;
use Diogo\PdiAdapter\Domain\PaymentData;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class CreditCardPaymentTypeRequestTest extends TestCase
{
	#[Test]
	public function dispatchRequestShouldReturnExpectedResponse(): void
	{
		$mock = new MockHandler([
			new Response(200, ['Content-Type' => 'application/json'], '{"id": 1,"status": "OK"}'),
		]);

		$handlerStack = HandlerStack::create($mock);
		$client = new Client(['handler' => $handlerStack]);

		$creditCardPaymentTypeRequest = new CreditCardPaymentTypeRequest(
			new PaymentData('1', 'produto', 10),
			'fake-method',
			'fake-uri',
			$client
		);

		$response = $creditCardPaymentTypeRequest->dispatchRequest();

		$this->assertEquals(200, $response->getStatusCode());
		$this->assertEquals('{"id": 1,"status": "OK"}', (string)$response->getBody());
	}
}
