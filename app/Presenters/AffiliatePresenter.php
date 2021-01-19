<?php

declare(strict_types=1);

namespace App\Presenters;


use App\Model\Exception\AffiliateUrlNotFoundByHashException;
use App\Model\Exception\ProductNotFoundByAffiliateHashException;
use App\Model\Service\ProcessAffiliateHashAndGetRedirectUrlService;
use Nette\Application\BadRequestException;

final class AffiliatePresenter extends BasePresenter
{
	private ProcessAffiliateHashAndGetRedirectUrlService $processAffiliateHashAndGetRedirectUrlService;

	public function __construct(
		ProcessAffiliateHashAndGetRedirectUrlService $processAffiliateHashAndGetRedirectUrlService
	) {
		parent::__construct();
		$this->processAffiliateHashAndGetRedirectUrlService = $processAffiliateHashAndGetRedirectUrlService;
	}

	public function actionRedirect(string $hash): void
	{
		try {
			$redirectUrl = $this->processAffiliateHashAndGetRedirectUrlService->process($hash);
			$this->redirectUrl($redirectUrl);
		} catch (AffiliateUrlNotFoundByHashException | ProductNotFoundByAffiliateHashException  $exception) {
			// 404
			throw new BadRequestException();
		}
	}
}
