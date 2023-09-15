<?php

declare(strict_types=1);

namespace Src\Tenant\Modules\System\Log\Domain\Interfaces;

use Src\Tenant\Modules\System\Log\Domain\Entities\SystLog;

interface LogRepositoryInterface
{
    public function registerLog(SystLog $systErrorLog);

}