<?php

declare(strict_types=1);

namespace Test\Diogo\PdiAdapter\Domain;

use Diogo\PdiAdapter\Domain\PaymentTypeEnum;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;

final class PaymentTypeEnumTest extends TestCase
{
    #[Test]
    public function shouldGetAllValuesAsExpected(): void
    {
		$expectedPaymentTypeArray = [
			'Diogo\PdiAdapter\Application\PaymentProcessor\PaymentType\CreditCardPaymentType' => 'CREDIT_CARD',
			'Diogo\PdiAdapter\Application\PaymentProcessor\PaymentType\EWalletPaymentType' => 'EWALLET',
			'Diogo\PdiAdapter\Application\PaymentProcessor\PaymentType\BoletoPaymentType' => 'BOLETO',
		];

		$paymentTypeEnum  = PaymentTypeEnum::getAllValues();

		$this->assertEquals($expectedPaymentTypeArray, $paymentTypeEnum);
	}
}
