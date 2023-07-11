<?php

declare(strict_types=1);

namespace Diogo\PdiAdapter\Application\Commons;

/** @psalm-suppress MixedInferredReturnType, MixedReturnStatement */
enum EnvironmentEnum: string
{
    case TEST = 'test/_support/DBMSPersistence/client.sqlite';
    case PRODUCTION = 'Infrastructure/DBMSPersistence/SQLite/client.sqlite';

	/** @psalm-suppress MixedInferredReturnType, MixedReturnStatement */
	public static function fromEnvironment(string $environment): self
	{
		/** @psalm-suppress MixedInferredReturnType, MixedReturnStatement */
        return constant("self::$environment");
    }
}
