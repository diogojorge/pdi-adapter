<?php

declare(strict_types=1);

namespace Diogo\PdiAdapter\Application\PaymentProcessor\PaymentType;

use Diogo\PdiAdapter\Domain\PaymentData;
use Psr\Http\Message\ResponseInterface;

interface PaymentTypeInterface
{
	public function processRequest(PaymentData $payment): ResponseInterface;
}
