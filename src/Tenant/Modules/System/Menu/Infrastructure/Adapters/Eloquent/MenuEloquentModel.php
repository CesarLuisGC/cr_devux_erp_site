<?php

declare(strict_types=1);

namespace Src\Tenant\Modules\System\Menu\Infrastructure\Adapters\Eloquent;

use Illuminate\Database\Eloquent\Model;

final class MenuEloquentModel extends Model
{
    protected $table = 'syst_menus';
    protected $fillable = [
        'id',
        'name',
        'module_id',
        'route',
        'icon',
        'parent',
        'order',
        'permission',
        'status'
    ];

}