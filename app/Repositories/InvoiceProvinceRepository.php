<?php

namespace App\Repositories;

use App\Models\InvoiceProvince;
use InfyOm\Generator\Common\BaseRepository;

class InvoiceProvinceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return InvoiceProvince::class;
    }
}
