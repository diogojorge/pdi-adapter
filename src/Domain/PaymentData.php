<?php

declare(strict_types=1);

namespace Diogo\PdiAdapter\Domain;

final class PaymentData
{
    public function __construct(
        private string $id,
        private string $description,
        private float $amount,
		private string $status = 'open'
    ) {
    }

	public function setStatus(string $status): void
	{
		$this->status = $status;
	}

    public function getId(): string
    {
        return $this->id;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

	public function getStatus(): string
	{
		return $this->status;
	}
}
