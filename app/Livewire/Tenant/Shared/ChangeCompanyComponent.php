<?php

namespace App\Livewire\Tenant\Shared;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Src\Tenant\Shared\Business;
use Livewire\Component;

class ChangeCompanyComponent extends Component
{
    protected $myCompanies;
    protected $myMainCompany;

    public function mount()
    {
        $business = new Business();
        $this->myMainCompany = $business->getMainCompany();
        $this->myCompanies = DB::table('buss_companies')
            ->select('buss_companies.country_id', 'buss_companies.id', 'buss_companies.name')
            ->join("secu_users_has_buss_companies", "secu_users_has_buss_companies.company_id", "=", "buss_companies.id")
            ->join("users", "users.id", "=", "secu_users_has_buss_companies.user_id")
            ->where('secu_users_has_buss_companies.country_id', $this->myMainCompany->country_id)
            ->where('secu_users_has_buss_companies.user_id', Auth::user()->id)->get();
    }

    public function render()
    {
        return view('livewire.tenant.shared.change-company-component', [
            'myCompanies' => $this->myCompanies,
            'mainCompanyName' => $this->myMainCompany->company_name
        ]);
    }

    public function changeCompany($country_id, $company_id)
    {
        DB::update('update secu_users_has_buss_companies set main = 0 where country_id=' . $country_id . ' and user_id =' . Auth::user()->id);
        DB::update('update secu_users_has_buss_companies set main = 1 where country_id=' . $country_id . ' and company_id = ' . $company_id . ' and user_id =' . Auth::user()->id);
        return redirect()->to('tenant/dashboard');
    }
}
