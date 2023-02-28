<?php

declare(strict_types=1);

namespace Diogo\PdiAdapter\Application;

use Diogo\PdiAdapter\Domain\Client;
use Diogo\PdiAdapter\Infrastructure\PersistenceInterface;

final class PersistenceAdapter
{
    private PersistenceInterface $persistence;

    public function __construct(PersistenceInterface $persistence)
    {
        $this->persistence = $persistence;
    }

    public function save(Client $client): void
    {
        $this->persistence->save($client);
    }

    /** @return array<int, string> */
    public function list(): array
    {
        return $this->persistence->list();
    }
}
