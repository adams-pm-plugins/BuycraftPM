<?php

declare(strict_types=1);

namespace tebexio\pocketmine\thread\response;

use tebexio\pocketmine\thread\TebexException;

final class TebexResponseFailureHolder extends TebexResponseHolder{

	/** @var TebexException */
	private $exception;

	public function __construct(int $handler_id, float $latency, TebexException $exception){
		parent::__construct($handler_id, $latency);
		$this->exception = $exception;
	}

	public function trigger(TebexResponseHandler $handler) : void{
		($handler->on_failure)($this->exception);
	}
}