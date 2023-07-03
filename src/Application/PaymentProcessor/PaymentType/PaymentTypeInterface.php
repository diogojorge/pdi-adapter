<?php

declare(strict_types=1);

namespace Diogo\PdiAdapter\Application\PaymentProcessor\PaymentType;

use Diogo\PdiAdapter\Domain\PaymentData;
use GuzzleHttp\Psr7\Response;

interface PaymentTypeInterface
{
	public function processRequest(PaymentData $payment): Response;
}
