<?php

declare(strict_types=1);

namespace App\Model\Entity;


final class Product
{
	private int $id;
	private string $url;
	private float $bidPrice;

	public function __construct(int $id, string $url, float $bidPrice)
	{
		$this->id = $id;
		$this->url = $url;
		$this->bidPrice = $bidPrice;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getUrl(): string
	{
		return $this->url;
	}

	public function getBidPrice(): float
	{
		return $this->bidPrice;
	}
}
