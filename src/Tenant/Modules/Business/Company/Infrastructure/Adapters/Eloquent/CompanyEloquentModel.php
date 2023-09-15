<?php

declare(strict_types=1);

namespace Src\Tenant\Modules\Business\Company\Infrastructure\Adapters\Eloquent;

use Illuminate\Database\Eloquent\Model;

final class CompanyEloquentModel extends Model
{
    protected $table = 'buss_companies';

    protected $fillable = [
        'country_id',
        'id',
        'name',
        'businessName',
        'identification_types_id',
        'identification',
        'email',
        'address',
        'telephone',
        'cellphone',
        'website',
        'image',
        'imageExt',
        'status'
    ];

}