<?php

declare(strict_types=1);

namespace App\Model\Facade;

use App\Model\Entity\AffiliateUrl;
use App\Model\Exception\AffiliateUrlNotFoundByHashException;


final class AffiliateUrlFacade extends BaseFacade
{
	public function getByHash(string $hash): AffiliateUrl
	{
		$q = $this->connection->select('au.id, au.partner_id, au.hash')
			->from('affiliate_url au')
			->where('au.hash = %s', $hash);
		$data = $q->fetch();

		if ($data === null) {
			throw new AffiliateUrlNotFoundByHashException();
		} else {
			return new AffiliateUrl((int)$data['id'], (int)$data['partner_id'], (string)$data['hash']);
		}
	}
}
