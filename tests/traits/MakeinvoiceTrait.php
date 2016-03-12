<?php

use Faker\Factory as Faker;
use App\Models\invoice;
use App\Repositories\invoiceRepository;

trait MakeinvoiceTrait
{
    /**
     * Create fake instance of invoice and save it in database
     *
     * @param array $invoiceFields
     * @return invoice
     */
    public function makeinvoice($invoiceFields = [])
    {
        /** @var invoiceRepository $invoiceRepo */
        $invoiceRepo = App::make(invoiceRepository::class);
        $theme = $this->fakeinvoiceData($invoiceFields);
        return $invoiceRepo->create($theme);
    }

    /**
     * Get fake instance of invoice
     *
     * @param array $invoiceFields
     * @return invoice
     */
    public function fakeinvoice($invoiceFields = [])
    {
        return new invoice($this->fakeinvoiceData($invoiceFields));
    }

    /**
     * Get fake data of invoice
     *
     * @param array $postFields
     * @return array
     */
    public function fakeinvoiceData($invoiceFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'id' => $fake->word,
			'total_amount' => $fake->word,
			'account_type' => $fake->word,
			'status' => $fake->word,
			'created_at' => $fake->word,
			'updated_at' => $fake->word
        ], $invoiceFields);
    }
}