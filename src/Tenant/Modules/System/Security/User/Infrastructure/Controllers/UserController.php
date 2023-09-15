<?php

declare(strict_types=1);

namespace Src\Tenant\Modules\System\Security\User\Infrastructure\Controllers;

use Src\Tenant\Modules\System\Security\User\Application\UseCases\GetAllUseCase;
use Src\Tenant\Modules\System\Security\User\Application\UseCases\GetOneUseCase;
use Src\Tenant\Modules\System\Security\User\Application\UseCases\CreateUseCase;
use Src\Tenant\Modules\System\Security\User\Application\UseCases\UpdateUseCase;
use Src\Tenant\Modules\System\Security\User\Application\UseCases\DeleteUseCase;
use Src\Tenant\Modules\System\Security\User\Application\UseCases\ChangeLanguageUseCase;

use Src\Tenant\Modules\System\Security\User\Infrastructure\Adapters\FacadesDB\UserFacadesDBAdapter;
use Src\Tenant\Modules\System\Security\User\Infrastructure\Adapters\Eloquent\UserEloquentAdapter;

use Illuminate\Http\Request;

final class UserController
{
    private $repository;

    public function __construct()
    {
        $this->repository = new UserFacadesDBAdapter();
    }

    public function getAll()
    {
        try {
            $getAllUseCase = new GetAllUseCase($this->repository);
            $users = $getAllUseCase->__invoke();
            return $users;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getOne(Request $request)
    {
        try {
            $id = (int) $request->id;

            $getOneUseCase = new GetOneUseCase($this->repository);
            $user = $getOneUseCase->__invoke($id);
            return $user;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function create(Request $request)
    {
        try {
            $id = 0;
            $name = $request->name;
            $email = $request->email;
            $password = $request->password;
            $status = $request->status ?? true;
            $language = $request->language ?? 'es';
            $avatar = $request->avatar ?? '';
            $avatarType = $request->avatarType ?? '';

            $createUser = new CreateUseCase($this->repository);
            $createUser->__invoke($id, $name, $email, $password, $status, $language, $avatar, $avatarType);

            return '';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(Request $request)
    {
        try {
            $id = (int) $request->id;

            $getOneUseCase = new GetOneUseCase($this->repository);
            $user = $getOneUseCase->__invoke($id);

            $name = $request->name ?? $user->name()->value();
            $email = $request->email ?? $user->email()->value();
            $password = $request->password ?? $user->password()->value();
            $status = $request->status ?? $user->status()->value();
            $language = $request->language ?? $user->language()->value();
            $avatar = $request->avatar ?? $user->avatar()->value();
            $avatarType = $request->avatarType ?? $user->avatarType()->value();

            $updateUseCase = new UpdateUseCase($this->repository);
            $updateUseCase->__invoke($id, $name, $email, $password, $status, $language, $avatar, $avatarType);

            $updatedUser = $getOneUseCase->__invoke($id);
            return $updatedUser;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete(Request $request)
    {
        try {
            $id = (int) $request->id;
            $deleteUseCase = new DeleteUseCase($this->repository);
            $deleteUseCase->__invoke($id);
            return '';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function changePassword(Request $request)
    {
        try {
            $id = (int) $request->id;
            $language = (string) $request->language;

            $changeLanguageUseCase = new ChangeLanguageUseCase($this->repository);
            $changeLanguageUseCase->__invoke($id, $language);

            return '';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}