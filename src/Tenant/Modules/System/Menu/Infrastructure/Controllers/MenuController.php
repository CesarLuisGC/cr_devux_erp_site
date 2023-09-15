<?php

declare(strict_types=1);

namespace Src\Tenant\Modules\System\Menu\Infrastructure\Controllers;

use Src\Tenant\Modules\System\Menu\Application\UseCases\GetAllUseCase;

use Src\Tenant\Modules\System\Menu\Infrastructure\Adapters\FacadesDB\MenuFacadesDBAdapter; //Adaptador de Facades DB ** Estos pueden variar según se requiera, esto es el objetivo de desacoplamiento **
use Src\Tenant\Modules\System\Menu\Infrastructure\Adapters\Eloquent\MenuEloquentAdapter; //Adaptador de Eloquent ** Estos pueden variar según se requiera, esto es el objetivo de desacoplamiento **

final class MenuController
{
    private $repository;

    public function __construct()
    {
        $this->repository = new MenuEloquentAdapter(); // (MenuFacadesDBAdapter / MenuEloquentAdapter) Acá podemos utilizar uno u otro y debería funcionar de manera transparente
    }

    public function getAll()
    {
        try {
            $getAllUseCase = new GetAllUseCase($this->repository);
            $menus = $getAllUseCase->getAll();
            return $menus;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}