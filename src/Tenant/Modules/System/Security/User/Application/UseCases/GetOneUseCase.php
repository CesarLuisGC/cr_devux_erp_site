<?php

declare(strict_types=1);

namespace Src\Tenant\Modules\System\Security\User\Application\UseCases;

use Src\Tenant\Modules\System\Security\User\Domain\Interfaces\UserRepositoryInterface;
use Src\Tenant\Modules\System\Security\User\Domain\Entities\SecuUser as User;

use Src\Tenant\Modules\System\Security\User\Domain\ValueObjects\Id;

final class GetOneUseCase
{
    private $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $id): ?User
    {
        $id = new Id($id);
        $user = $this->repository->getOne($id);
        return $user;
    }

}