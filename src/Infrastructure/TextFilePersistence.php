<?php

declare(strict_types=1);

namespace Diogo\PdiAdapter\Infrastructure;

use Diogo\PdiAdapter\Domain\Client;

final class TextFilePersistence implements PersistenceInterface
{
    public const FILE = 'src/Infrastructure/clients.txt';

    public static function save(Client $client): void
    {
        $file = fopen(self::FILE, "a");
        fwrite(
            $file,
            $client->getId() . PHP_EOL . $client->getName() . PHP_EOL . $client->getEmail() . PHP_EOL . PHP_EOL
        );
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
