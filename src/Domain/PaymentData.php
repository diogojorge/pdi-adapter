<?php

declare(strict_types=1);

namespace Diogo\PdiAdapter\Domain;

final class PaymentData
{
    public function __construct(
        private string $id,
        private string $description,
        private float $amount
    ) {
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
}
