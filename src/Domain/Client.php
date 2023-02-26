<?php

declare(strict_types=1);

namespace Diogo\PdiAdapter\Domain;

final class Client
{
    public function __construct(
        private string $id,
        private string $name,
        private string $email
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
