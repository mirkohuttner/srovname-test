<?php

declare(strict_types=1);

namespace App\Model\Facade;

use Dibi\Connection;


abstract class BaseFacade
{
	/** @inject */
	public Connection $connection;
}
