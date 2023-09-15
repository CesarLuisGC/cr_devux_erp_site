<?php

namespace Src\Tenant\Modules\Business\BranchOffice\Domain;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Utils\Business;

class BussBranchOffice extends Model
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
        'id',
        'name',
        'email',
        'address',
        'telephone',
        'cellphone',
        'status',
    ];

    public function initialize()
    {
        try {
            $business = new Business();
            $mainCompany = $business->getMainCompany();

            $this->country_id = $mainCompany->country_id;
            $this->company_id = $mainCompany->company_id;
            $this->name = '';
            $this->email = '';
            $this->address = '';
            $this->telephone = '';
            $this->cellphone = '';
            $this->status = 0;

            //Data generals
            $this->branchOffices;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function modelSelect()
    {
        try {
            $branchOffices = $this->executeSP('S');
            $this->branchOffices = $branchOffices;
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
            $branchOffice = $this->executeSP('L');
            $this->country_id = $branchOffice[0]->country_id;
            $this->company_id = $branchOffice[0]->company_id;
            $this->id = $branchOffice[0]->id;
            $this->name = $branchOffice[0]->name;
            $this->email = $branchOffice[0]->email;
            $this->address = $branchOffice[0]->address;
            $this->telephone = $branchOffice[0]->telephone;
            $this->cellphone = $branchOffice[0]->cellphone;
            $this->status = $branchOffice[0]->status;
            return '';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    private function executeSP($action)
    {
        try {
            $branchOffice = DB::select(
                'call sp_glob_branch_offices(?,?,?,?,?,?,?,?,?,?)',
                array(
                    $action,
                    $this->country_id,
                    $this->company_id,
                    $this->id,
                    $this->name,
                    $this->email,
                    $this->address,
                    $this->telephone,
                    $this->cellphone,
                    $this->status
                )
            );
            return $branchOffice;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}