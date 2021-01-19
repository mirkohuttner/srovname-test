<?php

declare(strict_types=1);

namespace App\Model\Service;

use App\Model\Entity\AffiliateUrl;
use App\Model\Entity\Product;
use Dibi\Connection;
use Nette\Http\IRequest;


final class LogAffiliateClickService
{
	private Connection $connection;
	private IRequest $request;

	public function __construct(Connection $connection, IRequest $request)
	{
		$this->connection = $connection;
		$this->request = $request;
	}

	public function log(AffiliateUrl $affiliateUrl, Product $product): void
	{
		$data = [
			'datetime' => new \DateTime(),
			'product_id' => $product->getId(),
			'affiliate_url_id' => $affiliateUrl->getId(),
			'click_price' => $product->getBidPrice(),
			'http_referer' => $this->request->getReferer(),
			'client_ip' => $this->request->getRemoteAddress()
			];
		$this->connection->query('INSERT INTO affiliate_url_log', $data);
	}
}
