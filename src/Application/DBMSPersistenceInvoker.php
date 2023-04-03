<?php

declare(strict_types=1);

namespace Diogo\PdiAdapter\Application;

/** @psalm-suppress MissingConstructor */
final class DBMSPersistenceInvoker
{
    private DBMSPersistenceCommandInterface $insert;
    private DBMSPersistenceCommandInterface $show;

    public function setInsertCommand(DBMSPersistenceCommandInterface $insert): void
    {
        $this->insert = $insert;
    }

    public function setShowCommand(DBMSPersistenceCommandInterface $show): void
    {
        $this->show = $show;
    }

    /**
     * @return array<int, string>
     * @psalm-suppress MixedInferredReturnType
     */
    public function insertAndShowData(): array
    {
        $this->insert->execute();

        /** @psalm-suppress MixedReturnStatement  */
        return $this->show->execute();
    }
}
