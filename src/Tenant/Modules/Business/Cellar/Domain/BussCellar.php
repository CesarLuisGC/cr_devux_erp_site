<?php

namespace Src\Tenant\Modules\Business\Cellar\Domain;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Utils\Business;

class BussCellar extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'country_id',
        'company_id',
        'branch_office_id',
        'id',
        'name',
        'status',
    ];

    public function initialize()
    {
        try {
            $business = new Business();
            $mainCompany = $business->getMainCompany();

            $this->country_id = $mainCompany->country_id;
            $this->company_id = $mainCompany->company_id;
            $this->branch_office_id = 0;
            $this->id = 0;
            $this->name = '';
            $this->status = 0;

            //Data generals
            $this->cellars;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function modelSelect()
    {
        try {
            $cellars = $this->executeSP('S');
            $this->cellars = $cellars;
            return '';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function modelStore()
    {
        try {
            $this->executeSP('I');
            return '';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function modelUpdate()
    {
        try {
            $this->executeSP('U');
            return '';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function modelLoad()
    {
        try {
            $cellar = $this->executeSP('L');
            $this->country_id = $cellar[0]->country_id;
            $this->company_id = $cellar[0]->company_id;
            $this->branch_office_id = $cellar[0]->branch_office_id;
            $this->id = $cellar[0]->id;
            $this->name = $cellar[0]->name;
            $this->status = $cellar[0]->status;
            return '';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    private function executeSP($action)
    {
        try {
            $cellar = DB::select(
                'call sp_glob_cellars(?,?,?,?,?,?,?)',
                array(
                    $action,
                    $this->country_id,
                    $this->company_id,
                    $this->branch_office_id,
                    $this->id,
                    $this->name,
                    $this->status
                )
            );
            return $cellar;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}