<?php

namespace App\Repositories;

use App\Models\Member;
use App\Models\Province;
use InfyOm\Generator\Common\BaseRepository;

class MemberRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        "first_name",
		"last_name"
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Member::class;
    }

    public function provinces()
    {
        return Province::lists('name', 'id');
    }
}
