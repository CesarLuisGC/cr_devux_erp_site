<?php

namespace Src\Tenant\Modules\System\Log\Domain\Entities;

use Src\Tenant\Modules\System\Log\Domain\ValueObjects\CountryId;
use Src\Tenant\Modules\System\Log\Domain\ValueObjects\CompanyId;
use Src\Tenant\Modules\System\Log\Domain\ValueObjects\ModuleId;
use Src\Tenant\Modules\System\Log\Domain\ValueObjects\Id;
use Src\Tenant\Modules\System\Log\Domain\ValueObjects\TypeLogId;
use Src\Tenant\Modules\System\Log\Domain\ValueObjects\UserId;
use Src\Tenant\Modules\System\Log\Domain\ValueObjects\Route;
use Src\Tenant\Modules\System\Log\Domain\ValueObjects\Process;
use Src\Tenant\Modules\System\Log\Domain\ValueObjects\Message;

final class SystLog
{
    private $countryId;
    private $companyId;
    private $moduleId;
    private $id;
    private $typeLogId;
    private $userId;
    private $route;
    private $process;
    private $message;

    public function __construct(CountryId $countryId, CompanyId $companyId, ModuleId $moduleId, Id $id, TypeLogId $typeLogId, UserId $userId, Route $route, Process $process, Message $message)
    {
        $this->countryId = $countryId;
        $this->companyId = $companyId;
        $this->moduleId = $moduleId;
        $this->id = $id;
        $this->typeLogId = $typeLogId;
        $this->userId = $userId;
        $this->route = $route;
        $this->process = $process;
        $this->message = $message;
    }


    public function getCountryId(): CountryId
    {
        return $this->countryId;
    }

    public function getCompanyId(): CompanyId
    {
        return $this->companyId;
    }

    public function getModuleId(): ModuleId
    {
        return $this->moduleId;
    }

    public function getId(): Id
    {
        return $this->id;
    }
    public function getTypeLogId(): TypeLogId
    {
        return $this->typeLogId;
    }

    public function getUserId(): UserId
    {
        return $this->userId;
    }

    public function getRoute(): Route
    {
        return $this->route;
    }

    public function getProcess(): Process
    {
        return $this->process;
    }

    public function getMessage(): Message
    {
        return $this->message;
    }

}