<?php

declare(strict_types=1);

namespace Diogo\PdiAdapter\Application\Commons;

final class CircuitBreaker
{
	private \Redis $redis;

	public function __construct(
		private string $cbKey = 'cb',
		private int $cbOpenCircuitTimeInSeconds = 15
	) {
		$this->redis = new \Redis();
		$this->redis->connect('pdi-redis', 6379);
	}

	public function open(): void
	{
		$this->redis->setex($this->cbKey, $this->cbOpenCircuitTimeInSeconds, 'true');
	}

	public function close(): void
	{
		$this->redis->del($this->cbKey);
	}

	public function isOpen(): bool
	{
		return (bool)$this->redis->exists($this->cbKey);
	}
}
