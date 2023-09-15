<?php

declare(strict_types=1);

namespace Src\Tenant\Modules\System\Menu\Application\UseCases;

use Src\Tenant\Modules\System\Menu\Domain\Interfaces\MenuRepositoryInterface;
use Src\Tenant\Modules\System\Menu\Domain\Entities\SystMenu as Menu;

use Src\Tenant\Modules\System\Menu\Domain\ValueObjects\Id;
use Src\Tenant\Modules\System\Menu\Domain\ValueObjects\Name;
use Src\Tenant\Modules\System\Menu\Domain\ValueObjects\ModuleId;
use Src\Tenant\Modules\System\Menu\Domain\ValueObjects\Route;
use Src\Tenant\Modules\System\Menu\Domain\ValueObjects\Icon;
use Src\Tenant\Modules\System\Menu\Domain\ValueObjects\MenuParent;
use Src\Tenant\Modules\System\Menu\Domain\ValueObjects\Order;
use Src\Tenant\Modules\System\Menu\Domain\ValueObjects\Permission;
use Src\Tenant\Modules\System\Menu\Domain\ValueObjects\Status;

final class GetAllUseCase
{
    private $repository;
    private $menuEntity;

    public function __construct(MenuRepositoryInterface $repository)
    {
        $this->repository = $repository;
        $this->menuEntity = new Menu(new Id(0), new Name(''), new ModuleId(0), new Route(''), new Icon(''), new MenuParent(''), new Order(''), new Permission(''), new Status(false));
    }

    public function getAll(): array
    {
        $data = $this->repository->getAll();
        $menus = $this->menuEntity->getFormatMenus($data);
        return $menus;
    }


}