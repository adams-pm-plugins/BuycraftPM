<?php

declare(strict_types=1);

namespace tebexio\pocketmine\api\bans;

use tebexio\pocketmine\api\TebexResponse;

final class TebexBanEntry implements TebexResponse{

	/**
	 * @param array<string, mixed> $response
	 * @return self
	 */
	public static function fromTebexResponse(array $response) : self{
		$user = $response["user"] ?? null;
		return new TebexBanEntry(
			$response["id"],
			$response["time"],
			$response["ip"],
			$response["payment_email"],
			$response["reason"],
			$user !== null ? new TebexBanEntryUser(
				$user["ign"],
				$user["uuid"]
			) : null
		);
	}

	/** @var int */
	private $id;

	/** @var string */
	private $time;

	/** @var string */
	private $ip;

	/** @var string */
	private $payment_email;

	/** @var string */
	private $reason;

	/** @var TebexBanEntryUser|null */
	private $user;

	public function __construct(int $id, string $time, string $ip, string $payment_email, string $reason, ?TebexBanEntryUser $user){
		$this->id = $id;
		$this->time = $time;
		$this->ip = $ip;
		$this->payment_email = $payment_email;
		$this->reason = $reason;
		$this->user = $user;
	}

	public function getId() : int{
		return $this->id;
	}

	public function getTime() : string{
		return $this->time;
	}

	public function getIp() : string{
		return $this->ip;
	}

	public function getPaymentEmail() : string{
		return $this->payment_email;
	}

	public function getReason() : string{
		return $this->reason;
	}

	public function getUser() : ?TebexBanEntryUser{
		return $this->user;
	}
}