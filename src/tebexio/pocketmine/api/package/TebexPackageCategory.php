<?php

declare(strict_types=1);

namespace tebexio\pocketmine\api\package;

final class TebexPackageCategory{

	/** @var int */
	private $id;

	/** @var string */
	private $name;

	public function __construct(int $id, string $name){
		$this->id = $id;
		$this->name = $name;
	}

	public function getId() : int{
		return $this->id;
	}

	public function getName() : string{
		return $this->name;
	}
}