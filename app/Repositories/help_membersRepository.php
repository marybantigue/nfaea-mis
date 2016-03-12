<?php

namespace App\Repositories;

use App\Models\help_members;
use InfyOm\Generator\Common\BaseRepository;

class help_membersRepository extends BaseRepository
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
        return help_members::class;
    }
}
