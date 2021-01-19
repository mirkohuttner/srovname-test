<?php

declare(strict_types=1);

namespace App\Model\Entity;


final class AffiliateUrl
{
	private int $id;
	private int $partnerId;
	private string $hash;

	public function __construct(int $id, int $partnerId, string $hash)
	{
		$this->id = $id;
		$this->partnerId = $partnerId;
		$this->hash = $hash;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getPartnerId(): int
	{
		return $this->partnerId;
	}
}
