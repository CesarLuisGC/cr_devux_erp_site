<?php

declare(strict_types=1);

namespace Src\Tenant\Modules\System\Security\User\Application\UseCases;

use Src\Tenant\Modules\System\Security\User\Domain\Interfaces\UserRepositoryInterface;

final class GetAllUseCase
{
    private $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke()
    {
        $users = $this->repository->getAll();
        return $users;
    }

}