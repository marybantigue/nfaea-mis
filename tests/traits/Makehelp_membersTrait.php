<?php

use Faker\Factory as Faker;
use App\Models\help_members;
use App\Repositories\help_membersRepository;

trait Makehelp_membersTrait
{
    /**
     * Create fake instance of help_members and save it in database
     *
     * @param array $helpMembersFields
     * @return help_members
     */
    public function makehelp_members($helpMembersFields = [])
    {
        /** @var help_membersRepository $helpMembersRepo */
        $helpMembersRepo = App::make(help_membersRepository::class);
        $theme = $this->fakehelp_membersData($helpMembersFields);
        return $helpMembersRepo->create($theme);
    }

    /**
     * Get fake instance of help_members
     *
     * @param array $helpMembersFields
     * @return help_members
     */
    public function fakehelp_members($helpMembersFields = [])
    {
        return new help_members($this->fakehelp_membersData($helpMembersFields));
    }

    /**
     * Get fake data of help_members
     *
     * @param array $postFields
     * @return array
     */
    public function fakehelp_membersData($helpMembersFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'id' => $fake->randomDigitNotNull,
			'member_id' => $fake->randomDigitNotNull,
			'invoice_id' => $fake->randomDigitNotNull,
			'amount' => $fake->word,
			'created_at' => $fake->word,
			'updated_at' => $fake->word
        ], $helpMembersFields);
    }
}