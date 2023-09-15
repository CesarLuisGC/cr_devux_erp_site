<?php

declare(strict_types=1);

namespace Src\Tenant\Modules\System\Security\User\Infrastructure\Controllers;

use Illuminate\Http\Request;

use Src\Tenant\Modules\System\Security\User\Application\UseCases\ChangeLanguageUseCase;

use Src\Tenant\Modules\System\Security\User\Infrastructure\Adapters\FacadesDB\UserFacadesDBAdapter;
use Src\Tenant\Modules\System\Security\User\Infrastructure\Adapters\Eloquent\UserEloquentAdapter;

final class ChangeLanguageController
{
    private $repository;

    public function __construct()
    {
        $this->repository = new UserFacadesDBAdapter();
    }
    public function __invoke(int $id, string $language)
    {
        try {
            $changeLanguageUseCase = new ChangeLanguageUseCase($this->repository);
            $changeLanguageUseCase->__invoke($id, $language);

            return '';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }




}