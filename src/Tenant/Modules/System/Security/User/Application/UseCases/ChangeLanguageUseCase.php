<?php

declare(strict_types=1);

namespace Src\Tenant\Modules\System\Security\User\Application\UseCases;

use Src\Tenant\Modules\System\Security\User\Domain\Interfaces\UserRepositoryInterface;
use Src\Tenant\Modules\System\Security\User\Domain\Entities\SecuUser as User;
use Illuminate\Support\Facades\App;

use Src\Tenant\Modules\System\Security\User\Domain\ValueObjects\Id;
use Src\Tenant\Modules\System\Security\User\Domain\ValueObjects\Name;
use Src\Tenant\Modules\System\Security\User\Domain\ValueObjects\Email;
use Src\Tenant\Modules\System\Security\User\Domain\ValueObjects\Password;
use Src\Tenant\Modules\System\Security\User\Domain\ValueObjects\Status;
use Src\Tenant\Modules\System\Security\User\Domain\ValueObjects\Language;
use Src\Tenant\Modules\System\Security\User\Domain\ValueObjects\Avatar;
use Src\Tenant\Modules\System\Security\User\Domain\ValueObjects\AvatarType;

use Src\Tenant\Modules\System\Security\User\Domain\ValueObjects\CountryId;
use Src\Tenant\Modules\System\Security\User\Domain\ValueObjects\CompanyId;
use Src\Tenant\Modules\System\Security\User\Domain\ValueObjects\Main;

final class ChangeLanguageUseCase
{
    private $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        int $id,
        string $language
    ): void {
        $id = new Id($id);
        $language = new Language($language);

        $this->repository->changeLanguage($id, $language);

        App::setLocale($language->value());
        session()->put('language', $language);
    }
}