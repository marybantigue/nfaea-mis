<?php

use Faker\Factory as Faker;
use App\Models\Member;
use App\Repositories\MemberRepository;

trait MakeMemberTrait
{
    /**
     * Create fake instance of Member and save it in database
     *
     * @param array $memberFields
     * @return Member
     */
    public function makeMember($memberFields = [])
    {
        /** @var MemberRepository $memberRepo */
        $memberRepo = App::make(MemberRepository::class);
        $theme = $this->fakeMemberData($memberFields);
        return $memberRepo->create($theme);
    }

    /**
     * Get fake instance of Member
     *
     * @param array $memberFields
     * @return Member
     */
    public function fakeMember($memberFields = [])
    {
        return new Member($this->fakeMemberData($memberFields));
    }

    /**
     * Get fake data of Member
     *
     * @param array $postFields
     * @return array
     */
    public function fakeMemberData($memberFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'id' => $fake->word,
			'first_name' => $fake->text,
			'last_name' => $fake->text,
			'created_at' => $fake->word,
			'updated_at' => $fake->word
        ], $memberFields);
    }
}