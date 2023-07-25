<?php

declare(strict_types=1);

namespace Test\Diogo\PdiAdapter\Domain;

use Diogo\PdiAdapter\Domain\PaymentTypeEnum;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\DataProvider;

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

	/** @return \Generator<string, mixed> */
	public static function provideExpectedValueAccordingToThePaymentType(): iterable
	{
		yield 'CREDIT_CARD' => [
			'paymentType' => 'CREDIT_CARD',
			'expectedValue' => 'Diogo\PdiAdapter\Application\PaymentProcessor\PaymentType\CreditCardPaymentType',
		];
		yield 'EWALLET' => [
			'paymentType' => 'EWALLET',
			'expectedValue' => 'Diogo\PdiAdapter\Application\PaymentProcessor\PaymentType\EWalletPaymentType',
		];
		yield 'BOLETO' => [
			'paymentType' => 'BOLETO',
			'expectedValue' => 'Diogo\PdiAdapter\Application\PaymentProcessor\PaymentType\BoletoPaymentType',
		];
	}

	#[Test]
	#[DataProvider('provideExpectedValueAccordingToThePaymentType')]
    public function shouldGetExpectedValue(string $paymentType, string $expectedValue): void
    {
		$value  = PaymentTypeEnum::fromName($paymentType)->value;

		$this->assertEquals($expectedValue, $value);
	}
}
