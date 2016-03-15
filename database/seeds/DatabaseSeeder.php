<?php

use Illuminate\Database\Seeder;
use GeneaLabs\LaravelGovernor\Action;
use GeneaLabs\LaravelGovernor\Entity;
use GeneaLabs\LaravelGovernor\Ownership;
use GeneaLabs\LaravelGovernor\Permission;
use GeneaLabs\LaravelGovernor\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        $superadmin = Role::whereName('SuperAdmin')->get()->first();
        $actions = Action::all();
        $ownership = Ownership::whereName('any')->get()->first();
        $entities = Entity::all();
        foreach ($entities as $entity) {
            foreach ($actions as $action) {
                $permission = new Permission();
                $permission->role()->associate($superadmin);
                $permission->action()->associate($action);
                $permission->ownership()->associate($ownership);
                $permission->entity()->associate($entity);
                $permission->save();
            }
        }
    }
}
