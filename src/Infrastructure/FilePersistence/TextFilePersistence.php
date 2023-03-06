<?php

declare(strict_types=1);

namespace Diogo\PdiAdapter\Infrastructure\FilePersistence;

use Diogo\PdiAdapter\Domain\ClientData;

final class TextFilePersistence implements FilePersistenceInterface
{
    public const FILE = 'src/Infrastructure/FilePersistence/clients.txt';

    public function save(ClientData $clientData): void
    {
        $file = fopen(self::FILE, "a");
        fwrite(
            $file,
            $clientData->getId() . PHP_EOL .
            $clientData->getName() . PHP_EOL .
            $clientData->getEmail() . PHP_EOL . PHP_EOL
        );
        fclose($file);
    }

    /** @return array<int, string> */
    public function list(): array
    {
        $list = [];

        if (!$file = @fopen(self::FILE, "r")) {
            throw new \Exception('File not found.');
        }

        while (($lineContent = fgets($file)) !== false) {
            $list[] = trim($lineContent);
        }
        fclose($file);

        return $list;
    }
}
