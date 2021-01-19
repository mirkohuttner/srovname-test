<?php

declare(strict_types=1);

namespace App\Model\Facade;

use App\Model\Entity\Product;
use App\Model\Exception\ProductNotFoundByAffiliateHashException;


final class ProductFacade extends BaseFacade
{
	public function getHighestProductUrlByAffiliateHash(string $affiliateHash): Product
	{
		$q = $this->connection->select('p.url, p.id, p.bid_price')
			->from('product p')
			->join('affiliate_url au')->on('au.product_id = p.id')
			->where('au.hash = %s', $affiliateHash)
			->orderBy(['p.bid_price' => 'DESC']);
		$data = $q->fetch();

		if ($data === null) {
			throw new ProductNotFoundByAffiliateHashException();
		} else {
			return new Product((int)$data['id'], (string)$data['url'], (float)$data['bid_price']);
		}
	}
}
