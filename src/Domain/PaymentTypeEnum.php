<?php

declare(strict_types=1);

namespace Diogo\PdiAdapter\Domain;

use Diogo\PdiAdapter\Application\PaymentProcessor\PaymentType\BoletoPaymentType;
use Diogo\PdiAdapter\Application\PaymentProcessor\PaymentType\CreditCardPaymentType;
use Diogo\PdiAdapter\Application\PaymentProcessor\PaymentType\EWalletPaymentType;

enum PaymentTypeEnum: string
{
    case CREDIT_CARD = CreditCardPaymentType::class;
    case EWALLET = EWalletPaymentType::class;
    case BOLETO = BoletoPaymentType::class;

	/**
	 * @return array<string, string>
	 */
	public static function getAllValues(): array
    {
        return array_column(PaymentTypeEnum::cases(), 'name', 'value');
    }

	/** @psalm-suppress MixedInferredReturnType, MixedReturnStatement */
	public static function fromName(string $name): self
	{
        return constant("self::$name");
    }
}
