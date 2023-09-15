<?php

declare(strict_types=1);

namespace Src\Tenant\Modules\System\Menu\Domain\Entities;

use Src\Tenant\Modules\System\Menu\Domain\ValueObjects\Id;
use Src\Tenant\Modules\System\Menu\Domain\ValueObjects\Name;
use Src\Tenant\Modules\System\Menu\Domain\ValueObjects\ModuleId;
use Src\Tenant\Modules\System\Menu\Domain\ValueObjects\Route;
use Src\Tenant\Modules\System\Menu\Domain\ValueObjects\Icon;
use Src\Tenant\Modules\System\Menu\Domain\ValueObjects\MenuParent;
use Src\Tenant\Modules\System\Menu\Domain\ValueObjects\Order;
use Src\Tenant\Modules\System\Menu\Domain\ValueObjects\Permission;
use Src\Tenant\Modules\System\Menu\Domain\ValueObjects\Status;

final class SystMenu
{
    private $id;
    private $name;
    private $moduleid;
    private $route;
    private $icon;
    private $parent;
    private $order;
    private $permission;
    private $status;

    public function __construct(Id $id, Name $name, ModuleId $moduleid, Route $route, Icon $icon, MenuParent $parent, Order $order, Permission $permission, Status $status)
    {
        $this->id = $id;
        $this->name = $name;
        $this->moduleid = $moduleid;
        $this->route = $route;
        $this->icon = $icon;
        $this->parent = $parent;
        $this->order = $order;
        $this->permission = $permission;
        $this->status = $status;
    }

    public function Id(): ?Id
    {
        return $this->id;
    }

    public function Name(): ?Name
    {
        return $this->name;
    }

    public function Module_Id(): ?ModuleId
    {
        return $this->moduleid;
    }

    public function Route(): ?Route
    {
        return $this->route;
    }

    public function Icon(): ?Icon
    {
        return $this->icon;
    }

    public function Parent(): ?MenuParent
    {
        return $this->parent;
    }

    public function Order(): ?Order
    {
        return $this->order;
    }

    public function Permission(): ?Permission
    {
        return $this->permission;
    }

    public function Status(): ?Status
    {
        return $this->status;
    }

    public function getFormatMenus(array $data)
    {
        $menuAll = [];
        foreach ($data as $line) {
            $item = [array_merge($line, ['submenu' => $this->getChildrenMenus($data, $line)])];
            $menuAll = array_merge($menuAll, $item);
        }
        return $menuAll;
    }

    private function getChildrenMenus($data, $line): ?array
    {
        $children = [];
        foreach ($data as $line1) {
            if ($line['id'] === $line1['parent']) {
                $children = array_merge($children, [array_merge($line1, ['submenu' => $this->getChildrenMenus($data, $line1)])]);
            }
        }
        return $children;
    }
}