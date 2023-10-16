<?php

declare(strict_types=1);

namespace Diogo\PdiAdapter\Application\API\Serving;

use Diogo\PdiAdapter\Application\Commons\CircuitBreaker;
use Diogo\PdiAdapter\Infrastructure\DBMSPersistence\SQLiteDBMSPersistence;
use Diogo\PdiAdapter\Application\Commons\EnvironmentEnum;
use Diogo\PdiAdapter\Application\PaymentProcessor\PaymentProcessor;
use Diogo\PdiAdapter\Domain\ClientData;
use Diogo\PdiAdapter\Domain\PaymentData;
use Diogo\PdiAdapter\Domain\PaymentTypeEnum;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;

final class PaymentsServing
{
	private const CPF_VALIDATION_TIMEOUT = 15;

	/** @psalm-suppress PossiblyInvalidCast, PossiblyInvalidArgument, InvalidStringClass, RiskyCast, ArgumentTypeCoercion, ForbiddenCode */
	public static function execute(): void
	{
		header("Access-Control-Allow-Origin: *");
		header("Content-Type: application/json; charset=UTF-8");

		$payment = '';
		try {
			self::validateRequestMethod();
			self::validateRequiredFields();
			self::validatePaymentType();
			$circuitBreaker = new CircuitBreaker('CPF_VALIDATION_TIMEOUT');
			if (!$circuitBreaker->isOpen()) {
				self::validateCPF();
			}
			self::validateClientEmail();

			$payment = new PaymentData('1', 'compra do ' . (string)$_POST['name'], (float)$_POST['amount']);
			$normalizePaymentType = mb_strtoupper($_POST['payment_type']);
			$paymentTypeClass = PaymentTypeEnum::fromName($normalizePaymentType)->value;
			$paymentProcessor = new PaymentProcessor();
			$paymentProcessingResult = $paymentProcessor->execute($payment, new $paymentTypeClass());
			$isValidPayment = $paymentProcessor->validateResponse($paymentProcessingResult);

			http_response_code(200);
			$payment->setStatus(self::resolvePaymentStatus($circuitBreaker, $isValidPayment));
		} catch (\Exception $exception) {
			http_response_code(404);
			echo $exception->getMessage();
			exit();
		} finally {
			var_dump($payment);
		}
	}

	/** @psalm-suppress PossiblyInvalidCast, PossiblyInvalidArgument, PossiblyUndefinedArrayOffset */
	private static function validateRequestMethod(): void
	{
		if ($_SERVER['REQUEST_METHOD'] === 'GET') {
			throw new \Exception("Invalid method: `{$_SERVER['REQUEST_METHOD']}`");
		}
	}

	/** @psalm-suppress PossiblyInvalidCast, PossiblyInvalidArgument */
	private static function validateRequiredFields(): void
	{
		switch (true) {
			case !isset($_POST['name']):
				throw new \Exception("Required field: `name`");
			case !isset($_POST['email']):
				throw new \Exception("Required field: `email`");
			case !isset($_POST['cpf']):
				throw new \Exception("Required field: `cpf`");
			case !isset($_POST['amount']):
				throw new \Exception("Required field: `amount`");
			case !isset($_POST['payment_type']):
				throw new \Exception("Required field: `payment_type`");
		}
	}

	/** @psalm-suppress PossiblyInvalidCast, PossiblyInvalidArgument */
	private static function validatePaymentType(): void
	{
		$paymentTypeOptions  = PaymentTypeEnum::getAllValues();
		$normalizePaymentType = mb_strtoupper($_POST['payment_type']);
		if (array_search($normalizePaymentType, $paymentTypeOptions) === false) {
			throw new \Exception("Unknown payment_type: `{$_POST['payment_type']}`");
		}
	}

	/** @psalm-suppress PossiblyInvalidCast, PossiblyInvalidArgument */
	private static function validateClientEmail(): void
	{
		$controller = new SQLiteDBMSPersistence(EnvironmentEnum::fromEnvironment('PRODUCTION'));
		$isClientEmailRegistered = $controller->isClientEmailRegistered($_POST['email']);
		if (!$isClientEmailRegistered) {
			$circuitBreaker = new CircuitBreaker('CPF_VALIDATION_TIMEOUT');
			if ($circuitBreaker->isOpen()) {
				$lastCpfValidation = null;
			} else {
				$lastCpfValidation = date("Y-m-d H:i:s");
			}
			$newClient = new ClientData('1', $_POST['name'], $_POST['email'], $_POST['cpf'], $lastCpfValidation);
			$controller->insert($newClient);
		}
	}

	/** @psalm-suppress PossiblyInvalidCast, PossiblyInvalidArgument, MixedAssignment, MixedPropertyFetch */
	private static function validateCPF(): void
	{
		if (strlen($_POST['cpf']) !== 11) {
			throw new \Exception("Invalid CPF: `{$_POST['cpf']}`");
		}

		try {
			$client = new Client();
			$requestCPFValidation = new Request(
				'PUT',
				'https://run.mocky.io/v3/e6465368-bd5d-42ae-916d-89a94982e724',
				['Content-Type' => 'application/json'],
				json_encode(['cpf' => $_POST['cpf'],]),
			);
			$requestResult = $client->send($requestCPFValidation, ['timeout' => self::CPF_VALIDATION_TIMEOUT,]);
			$response = json_decode((string)$requestResult->getBody());
			if ($response->status !== 'OK') {
				throw new \Exception("Invalid CPF: `{$_POST['cpf']}`");
			}
		} catch (GuzzleException $exception) {
			$circuitBreaker = new CircuitBreaker('CPF_VALIDATION_TIMEOUT');
			$circuitBreaker->open();
		}
	}

	/** @psalm-suppress PossiblyInvalidCast, PossiblyInvalidArgument */
	private static function resolvePaymentStatus(CircuitBreaker $circuitBreaker, bool $isValidPayment): string
	{
		if (!$isValidPayment) {
			return 'canceled';
		}
		if ($circuitBreaker->isOpen()) {
			return 'pending';
		}
		return 'confirmed';
	}
}
