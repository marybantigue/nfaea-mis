<?php

use Faker\Factory as Faker;
use App\Models\InvoiceMember;
use App\Repositories\InvoiceMemberRepository;

trait MakeInvoiceMemberTrait
{
    /**
     * Create fake instance of InvoiceMember and save it in database
     *
     * @param array $invoiceMemberFields
     * @return InvoiceMember
     */
    public function makeInvoiceMember($invoiceMemberFields = [])
    {
        /** @var InvoiceMemberRepository $invoiceMemberRepo */
        $invoiceMemberRepo = App::make(InvoiceMemberRepository::class);
        $theme = $this->fakeInvoiceMemberData($invoiceMemberFields);
        return $invoiceMemberRepo->create($theme);
    }

    /**
     * Get fake instance of InvoiceMember
     *
     * @param array $invoiceMemberFields
     * @return InvoiceMember
     */
    public function fakeInvoiceMember($invoiceMemberFields = [])
    {
        return new InvoiceMember($this->fakeInvoiceMemberData($invoiceMemberFields));
    }

    /**
     * Get fake data of InvoiceMember
     *
     * @param array $postFields
     * @return array
     */
    public function fakeInvoiceMemberData($invoiceMemberFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'id' => $fake->randomDigitNotNull,
			'member_id' => $fake->randomDigitNotNull,
			'invoice_id' => $fake->randomDigitNotNull,
			'paid' => $fake->word,
			'created_at' => $fake->word,
			'updated_at' => $fake->word
        ], $invoiceMemberFields);
    }
}