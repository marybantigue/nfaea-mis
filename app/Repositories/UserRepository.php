<?php

namespace App\Repositories;

use App\User;
use App\Role;
use InfyOm\Generator\Common\BaseRepository;

class UserRepository extends BaseRepository
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
        return User::class;
    }

    public function rolesAvailable(){
        return Role::lists('name', 'id');
    }

    public function roles()
    {
        
        // return Member::lists(`full_name`, 'id');
        return User::roles();
    }
}
