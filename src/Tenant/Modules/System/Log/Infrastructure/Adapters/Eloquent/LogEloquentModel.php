<?php

declare(strict_types=1);

namespace Src\Tenant\Modules\System\Log\Infrastructure\Adapters\Eloquent;

use Illuminate\Database\Eloquent\Model;

final class LogEloquentModel extends Model
{
    protected $table = 'syst_log';

    protected $fillable = [
        'country_id',
        'company_id',
        'module_id',
        'id',
        'typeLogId',
        'user_id',
        'id',
        'route',
        'process',
        'message'
    ];

}