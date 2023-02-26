<?php

declare(strict_types=1);

namespace Diogo\PdiAdapter\Application;

use Diogo\PdiAdapter\Domain\Client;

final class Controller
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

    public static function list(): void
    {
        $file = fopen(self::FILE, "r");
        if ($file) {
            while (!feof($file)) {
                $content = fgets($file);
                echo $content;
            }
            fclose($file);
        } else {
            echo 'Arquivo não existe';
        }
    }
}
