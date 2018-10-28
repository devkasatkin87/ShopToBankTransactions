<?php

namespace Source;

use Datto\JsonRpc\Evaluator;
use Datto\JsonRpc\Exceptions\ArgumentException;
use Datto\JsonRpc\Exceptions\MethodException;

class Bank implements Evaluator
{

	/**
	 * @param string $method
	 * @param array $arguments
	 * @return mixed
	 */
	public function evaluate($method, $arguments)
	{
		if (count($arguments) !== 5) {
			throw new ArgumentException();
		}

		switch ($method) {
			case 'block':
				$result = $this->block(...$arguments);
				break;
			case 'withdraw':
				$result = $this->withdraw(...$arguments);
				break;
			default:
				throw new MethodException();
		}
		return $result;
	}

	public function block(string $name, string $cardNumber, string $expiryDate, string $codeCvv, int $summ) : string
	{
		return "$summ$ has blocked for $name account";
	}

	public function withdraw(string $name, string $cardNumber, string $expiryDate, string $codeCvv, int $summ) : string
	{
		return "$summ$ has withdrawed for $name account";
	}
}