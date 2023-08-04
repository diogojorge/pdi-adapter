<?php

declare(strict_types=1);

namespace Diogo\PdiAdapter\Domain;

final class ClientData
{
    public function __construct(
        private string $id,
        private string $name,
        private string $email,
		private string $cpf,
		private string $lastCpfValidation
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

	public function getCpf(): string
	{
		return $this->cpf;
	}

	public function getLastCpfValidation(): string
	{
		return $this->lastCpfValidation;
	}
}
