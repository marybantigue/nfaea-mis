<?php

namespace App\Repositories;

use App\Models\province;
use InfyOm\Generator\Common\BaseRepository;

class provinceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        "name"
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return province::class;
    }

    public function provinces()
    {
        return Province::lists('name', 'id');
    }
}
