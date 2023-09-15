<?php

namespace Src\Tenant\Modules\Business\IdentificationType\Infrastructure\Adapters\Eloquent;

use Illuminate\Database\Eloquent\Model;

class IdentificationTypeEloquentModel extends Model
{
    protected $table = 'buss_identification_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'country_id',
        'id',
        'name',
        'format',
        'status',
    ];

}