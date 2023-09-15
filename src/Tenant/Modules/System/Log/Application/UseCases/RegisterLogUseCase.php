<?php

declare(strict_types=1);

namespace Src\Tenant\Modules\System\Log\Application\UseCases;

use Src\Tenant\Modules\System\Log\Domain\Interfaces\LogRepositoryInterface;
use Src\Tenant\Modules\System\Log\Domain\Entities\SystLog;

use Src\Tenant\Modules\System\Log\Domain\ValueObjects\CountryId;
use Src\Tenant\Modules\System\Log\Domain\ValueObjects\CompanyId;
use Src\Tenant\Modules\System\Log\Domain\ValueObjects\ModuleId;
use Src\Tenant\Modules\System\Log\Domain\ValueObjects\Id;
use Src\Tenant\Modules\System\Log\Domain\ValueObjects\TypeLogId;
use Src\Tenant\Modules\System\Log\Domain\ValueObjects\UserId;
use Src\Tenant\Modules\System\Log\Domain\ValueObjects\Route;
use Src\Tenant\Modules\System\Log\Domain\ValueObjects\Process;
use Src\Tenant\Modules\System\Log\Domain\ValueObjects\Message;

final class RegisterLogUseCase
{
    private $repository;

    public function __construct(LogRepositoryInterface $transactionRepositoryInterface)
    {
        $this->repository = $transactionRepositoryInterface;
    }

    public function __invoke(int $countryId, int $companyId, int $moduleId, int $id, int $typeLogId, int $userId, string $route, string $process, string $error)
    {
        $countryId = new CountryId($countryId);
        $companyId = new CompanyId($companyId);
        $moduleId = new ModuleId($moduleId);
        $id = new Id($id);
        $typeLogId = new TypeLogId($typeLogId);
        $userId = new UserId($userId);
        $route = new Route($route);
        $process = new Process($process);
        $error = new Message($error);

        $transaction = new SystLog(
            $countryId,
            $companyId,
            $moduleId,
            $id,
            $typeLogId,
            $userId,
            $route,
            $process,
            $error
        );

        return $this->repository->registerLog($transaction);
    }

}