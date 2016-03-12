<?php

use Faker\Factory as Faker;
use App\Models\invoices_members;
use App\Repositories\invoices_membersRepository;

trait Makeinvoices_membersTrait
{
    /**
     * Create fake instance of invoices_members and save it in database
     *
     * @param array $invoicesMembersFields
     * @return invoices_members
     */
    public function makeinvoices_members($invoicesMembersFields = [])
    {
        /** @var invoices_membersRepository $invoicesMembersRepo */
        $invoicesMembersRepo = App::make(invoices_membersRepository::class);
        $theme = $this->fakeinvoices_membersData($invoicesMembersFields);
        return $invoicesMembersRepo->create($theme);
    }

    /**
     * Get fake instance of invoices_members
     *
     * @param array $invoicesMembersFields
     * @return invoices_members
     */
    public function fakeinvoices_members($invoicesMembersFields = [])
    {
        return new invoices_members($this->fakeinvoices_membersData($invoicesMembersFields));
    }

    /**
     * Get fake data of invoices_members
     *
     * @param array $postFields
     * @return array
     */
    public function fakeinvoices_membersData($invoicesMembersFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'id' => $fake->randomDigitNotNull,
			'member_id' => $fake->randomDigitNotNull,
			'invoice_id' => $fake->randomDigitNotNull,
			'paid' => $fake->word,
			'created_at' => $fake->word,
			'updated_at' => $fake->word
        ], $invoicesMembersFields);
    }
}