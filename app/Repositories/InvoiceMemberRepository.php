<?php

namespace App\Repositories;

use App\Models\InvoiceMember;
use InfyOm\Generator\Common\BaseRepository;

class InvoiceMemberRepository extends BaseRepository
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
        return InvoiceMember::class;
    }
}
