<?php

declare(strict_types=1);

namespace Test\Diogo\PdiAdapter\Application\Commons;

use Diogo\PdiAdapter\Application\Commons\CircuitBreaker;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;

final class CircuitBreakerTest extends TestCase
{
	#[Test]
	public function isOpen(): void
	{
		$cb = new CircuitBreaker();

		$cb->open();

		$this->assertTrue($cb->isOpen());
		$cb->Close();
	}

	#[Test]
	public function isClose(): void
	{
		$cb = new CircuitBreaker();

		$this->assertFalse($cb->isOpen());
	}
}
