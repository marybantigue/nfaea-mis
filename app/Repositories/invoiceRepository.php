<?php

namespace App\Repositories;

use App\Models\Member;
use App\Models\Province;
use App\Models\invoice;
use InfyOm\Generator\Common\BaseRepository;

class invoiceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        "account_type",
		"status"
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return invoice::class;
    }

    public function provinces()
    {
        return Province::lists('name', 'id');
    }

    public function membersNames()
    {
        
        // return Member::lists(`full_name`, 'id');
        return Member::all()->lists('full_name', 'id');
    }

    public function helpMembers()
    {
        
        // return Member::lists(`full_name`, 'id');
        return invoice::helpMembers();
    }

    public function province()
    {
        return invoice::province();
    }

    public function members()
    {
        return invoice::members();
    }

    public function provinceMembers($province_id){
        //return Member::with('province')->find($province_id);
        return Province::with('members')->find($province_id)->members;
//        return Member::where('province_id', '=', $province_id)->invoice;
        //return invoice::helpMembers();

        // get members of the province with invoice poivot
    }
    public function findByProvince($province_id){
        //return Province::with('invoices')->find($province_id)->invoices;
       // return invoice::with('province')->get()->where('province_id',$province_id)->get();

        return invoice::with(['province' => function ($query) use ($province_id) {
            $query->where('province_id', $province_id);

        }])->get();
    }
    public function invoicesProvinces(){
        //return $this->province();
        return invoice::with('province')->get();
    }

    public function findInvoiceFromPivot($id, $province_id){

         return invoice::with(
                ['province'=> function ($query) use ($province_id, $id) {
                    $query->where('province_id','=', $province_id)
                            ->where('invoice_id', '=', $id)
                            ->first();
                }
            ,   'members' => function ($query) use ($province_id, $id) {
                        $query->where('province_id', '=', $province_id)
                            ->get();
                    }
            , 'helpMembers'  => function ($query) use ($id) {
                        $query->where('invoice_id', '=', $id)
                            ->get();
                    }])->find($id);
    }

    public function invoiceWithProvince($id, $province_id){
         return invoice::with(
                ['province'=> function ($query) use ($province_id, $id) {
                    $query->where('province_id','=', $province_id)
                            ->where('invoice_id', '=', $id)
                            ->first();
                }
            ])->find($id); 
    }

}


