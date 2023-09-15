<?php

declare(strict_types=1);

namespace Src\Tenant\Modules\System\Log\Infrastructure\Adapters\Eloquent;

use Src\Tenant\Modules\System\Log\Domain\Interfaces\LogRepositoryInterface;
use Src\Tenant\Modules\System\Log\Domain\Entities\SystLog;

use Src\Tenant\Modules\System\Log\Domain\ValueObjects\CountryId;
use Src\Tenant\Modules\System\Log\Domain\ValueObjects\CompanyId;
use Src\Tenant\Modules\System\Log\Domain\ValueObjects\ModuleId;
use Src\Tenant\Modules\System\Log\Domain\ValueObjects\UserId;
use Src\Tenant\Modules\System\Log\Domain\ValueObjects\Route;
use Src\Tenant\Modules\System\Log\Domain\ValueObjects\Process;
use Src\Tenant\Modules\System\Log\Domain\ValueObjects\Error;

final class LogEloquentAdapter implements LogRepositoryInterface
{
    private $errorLogEloquentModel;

    public function __construct(SystLog $systLog)
    {
        $this->errorLogEloquentModel = $systLog;
    }

    public function registerLog(SystLog $systLog)
    {
        return '';
    }

}