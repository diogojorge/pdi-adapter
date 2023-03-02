<?php

declare(strict_types=1);

namespace Diogo\PdiAdapter\Infrastructure;

use Diogo\PdiAdapter\Domain\ClientData;

final class CsvFilePersistence implements PersistenceInterface
{
    public const FILE = 'src/Infrastructure/clients.csv';

    public static function save(ClientData $clientData): void
    {
        $file = fopen(self::FILE, "a");
        $fields = [$clientData->getId(), $clientData->getName(), $clientData->getEmail(),];
        fputcsv($file, $fields);
        fclose($file);
    }

    /** @return array<int, string> */
    public static function list(): array
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
