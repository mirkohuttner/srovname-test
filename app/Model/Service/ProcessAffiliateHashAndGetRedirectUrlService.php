<?php

declare(strict_types=1);

namespace App\Model\Service;

use App\Model\Exception\AffiliateUrlNotFoundByHashException;
use App\Model\Exception\ProductNotFoundByAffiliateHashException;
use App\Model\Facade\AffiliateUrlFacade;
use App\Model\Facade\ProductFacade;


final class ProcessAffiliateHashAndGetRedirectUrlService
{
	private ProductFacade $productFacade;
	private AffiliateUrlFacade $affiliateUrlFacade;
	private LogAffiliateClickService $logAffiliateClickService;

	public function __construct(
		ProductFacade $productFacade,
		AffiliateUrlFacade $affiliateUrlFacade,
		LogAffiliateClickService $logAffiliateClickService
	) {
		$this->productFacade = $productFacade;
		$this->affiliateUrlFacade = $affiliateUrlFacade;
		$this->logAffiliateClickService = $logAffiliateClickService;
	}

	public function process(string $affiliateHash): string
	{
		try {
			$affiliateUrl = $this->affiliateUrlFacade->getByHash($affiliateHash);
			$product = $this->productFacade->getHighestProductUrlByAffiliateHash($affiliateHash);
			// todo: check for some period of time per one user, one user cannot click multiple times in one day
			$this->logAffiliateClickService->log($affiliateUrl, $product);

			return $product->getUrl();
		} catch (AffiliateUrlNotFoundByHashException | ProductNotFoundByAffiliateHashException  $exception) {
			throw $exception;
		}
	}
}
